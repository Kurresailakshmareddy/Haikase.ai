<?php
include("includes/header.php");

require("function.php");

check_login();

if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
    $sql = " SELECT * FROM news WHERE `news`.`id` = '" . $_GET["edit"] . "' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $news_data = $result->fetch_assoc();
    }
}


if (isset($_POST["add-news"])) {

    $uploadOk = 0;

    $image = basename($_FILES["image"]["name"]);
    $file = basename($_FILES["file"]["name"]);

    if (empty($image)) {
        $_SESSION["error"] = "Please add news image";
        $uploadOk = 1;
    } else {

        if (file_exists("./uploads/news/" . $image)) {
            $image = time() . $image;
        }

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/news/" . $image)) {
            $_SESSION["error"] = "There was an error uploading news image file.";
            $uploadOk = 1;
        }
    }


    if (file_exists("./uploads/news/" . $file)) {
        $file = time() . $file;
    }

    if (!move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/news/" . $file)) {
        $_SESSION["error"] = "There was an error uploading news pdf file.";
        $uploadOk = 1;
    }

    if (empty($uploadOk)) {

        $name = $conn->real_escape_string($_POST["name"]);
        $message = $conn->real_escape_string($_POST["message"]);

        $sql = " INSERT INTO `news`( `name`, `image`, `description`,`file`) VALUES ( '$name' , '$image' , '$message','$file') ; ";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"] = " New record created successfully . ";
        } else {
            $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    header("location: newscontentchange.php");
    die();
}

if (isset($_POST["update-news"])) {

    $name = $conn->real_escape_string($_POST["name"]);
    $message = $conn->real_escape_string($_POST["message"]);
    $image = basename($_FILES["image"]["name"]);
    $file = basename($_FILES["file"]["name"]);
    $image_name = $conn->real_escape_string($_POST["image_name"]);
    $file_name = $conn->real_escape_string($_POST["file_name"]);


    if (empty($image) && empty($image_name)) {
        $_SESSION["error"] = " Please add news image.";
    } else {
        if (!empty($image)) {
            if (file_exists("./uploads/news/" . $image)) {
                $image = time() . $image;
            }

            if (!move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/news/" . $image)) {
                $_SESSION["error"] = " there was an error uploading news image file.";
            }
        } else {
            $image = $image_name;
        }
    }


    if (!empty($file)) {
        if (file_exists("./uploads/news/" . $file)) {
            $file = time() . $file;
        }

        if (!move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/news/" . $file)) {
            $_SESSION["error"] = "There was an error uploading news pdf file.";
        }
    } else {
        $file = $file_name;
    }

    $sql = " UPDATE `news` SET `name`= '" . $name . "' , `image`= '" . $image . "' , `description`= '" . $message . "'  , `file`= '" . $file . "' WHERE `id`= '$_GET[edit]' ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = " Record Updated successfully . ";
    } else {
        $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
    }

    header("location: newscontentchange.php");
    die();
}



if (isset($_GET["id"])) {

    $sql = " SELECT news.image FROM news WHERE `news`.`id` = '" . $_GET["id"] . "' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!empty($row["image"])) {
        unlink("./uploads/news/" . $row["image"]);
    }

    $sql = " DELETE FROM news WHERE id= '" . $_GET["id"] . "' ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = " Record deleted successfully . ";
    } else {
        $_SESSION["error"] = "Error deleting record: " . $conn->error;
    }
    header("location: add_news_offered.php");
    die();
}
?>

<section class="page_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <a href="content_change.php">Home</a>
                    </li>
                    <li>
                        <a href="aboutcontentchange.php">About</a>
                    </li>
                    <li>
                        <a href="articles_blogschange.php">Articles and Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="news_main">
        <div class="heading-text">
            <p>News Content Change</p>
        </div>
        <div class="row">
            <?php
            if (isset($_SESSION["success"])) {
                echo '<div class="success">' . $_SESSION["success"] . '</div>';
                unset($_SESSION["success"]);
            } elseif (isset($_SESSION["error"])) {
                echo '<div class="error">' . $_SESSION["error"] . '</div>';
                unset($_SESSION["error"]);
            }
            ?>
            <div class="col-md-12">
                <div class="contact_form">
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Please enter the title here" vaule="<?php echo ($news_data['name'] != "") ? trim($news_data['name']) : ""; ?>" requried>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <?php if (!empty($news_data["image"])) { ?>
                                <img alt="Image Loading..!" src="./uploads/news/<?= $news_data["image"]; ?>" class="avatar rounded mr-3 " height="200">
                                <input type="hidden" name="image_name" id="image_name" class="form-control" placeholder="Please select the image" value="<?php echo $news_data['image']; ?>">
                            <?php } ?>
                            <input type="file" name="image" placeholder="Please the select the image in jpg/png" id="image" accept="image/*" class="form-control">
                            <h5 style="color: red;">*Please upload the image in jpg/png format</h5>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <?php if (!empty($news_data["file"])) { ?>
                                <a href="./uploads/news/<?= $news_data["file"]; ?>" target="_blank"><?php echo $news_data['file']; ?></a>
                                <input type="hidden" name="file_name" id="file_name" class="form-control" placeholder="Please select the file in only PDF" value="<?php echo $news_data['file']; ?>">
                            <?php } ?>
                            <input type="file" name="file" id="file" placeholder="Please select the file in only PDF" accept=".pdf" class="form-control">
                            <h5 style="color: red;">*Please upload the file in PDF only</h5>
                        </div>
                        <div class="form-group">
                            <label for="message">Description</label>
                            <textarea name="message" id="message" class="form-control" placeholder="Please enter the description here" value="<?php echo ($news_data['description'] != "") ? trim($news_data['description']) : ""; ?>" requried></textarea>
                        </div>
                        <?php
                        if (!empty($news_data['id'])) {
                        ?>
                            <button class="newsbtn" name="update-news" value="add-news">Update news</button>
                        <?php } else { ?>
                            <button class="newsbtn" name="add-news" value="add-news">Add news</button>
                        <?php } ?>
                    </form>
                </div>

            </div>
        </div>
        <hr>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = " SELECT news.* FROM news ORDER BY `news`.`id` DESC ";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i; ?>
                                        </th>
                                        <td>
                                            <div class="media align-items-center">
                                                <img alt="Image placeholder" src="./uploads/news/<?= $row["image"]; ?>" class="about_img">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        <?= $row["name"]; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width:70%;">
                                            <p>
                                                <?= $row["description"]; ?>
                                            </p>
                                        </td>
                                        <td style="width:100%;">
                                            <p>
                                                <a href="./uploads/news/<?= $row["file"]; ?>" download><?= $row["file"]; ?></a>
                                            </p>
                                        <td>
                                            <a href="newscontentchange.php?edit=<?= $row["id"]; ?>" class="content loginbtn"> Edit </a> |
                                            <a href="newscontentchange.php?id=<?= $row["id"]; ?>" class="content loginbtn"> Delete </a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No results</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>