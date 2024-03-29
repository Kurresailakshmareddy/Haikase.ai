<?php
include("../includes/admin/header.php");

require("./function.php");

check_login();

if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
  $sql = " SELECT * FROM about WHERE `about`.`id` = '" . $_GET["edit"] . "' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $about_data = $result->fetch_assoc();
  }
}


if (isset($_POST["add-about"])) {

  $uploadOk = 0;

  $image = basename($_FILES["image"]["name"]);

  if (empty($image)) {
    $_SESSION["error"] = "Please add about image.";
    $uploadOk = 1;
  } else {

    if (file_exists("../uploads/about/" . $image)) {
      $image = time() . $image;
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/about/" . $image)) {
      $_SESSION["error"] = " There was an error uploading about image file.";
      $uploadOk = 1;
    }
  }

  if (empty($uploadOk)) {

    $name = $conn->real_escape_string($_POST["name"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = " INSERT INTO `about`( `name`, `image`, `message`) VALUES ( '$name' , '$image' , '$message' ) ; ";

    if ($conn->query($sql) === TRUE) {
      $_SESSION["success"] = " New record created successfully . ";
    } else {
      $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  header("location: ./aboutcontentchange.php");
  die();
}


if (isset($_POST["update-about"])) {

  $name = $conn->real_escape_string($_POST["name"]);
  $message = $conn->real_escape_string($_POST["message"]);
  $image = basename($_FILES["image"]["name"]);
  $image_name = $conn->real_escape_string($_POST["image_name"]);


  if (empty($image) && empty($image_name)) {
    $_SESSION["error"] = " Please add about image.";
  } else {
    if (!empty($image)) {
      if (file_exists("../uploads/about/" . $image)) {
        $image = time() . $image;
      }

      if (!move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/about/" . $image)) {
        $_SESSION["error"] = " There was an error in uploading about image file.";
      }
    } else {
      $image = $image_name;
    }
  }

  $sql = " UPDATE `about` SET `name`= '" . $name . "' , `image`= '" . $image . "' , `message`= '$message'   WHERE `id`= '$_GET[edit]' ";

  if ($conn->query($sql) === TRUE) {
    $_SESSION["success"] = " Record Updated successfully . ";
  } else {
    $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
  }

  header("location: ./aboutcontentchange.php");
  die();
}


if (isset($_GET["id"])) {

  $sql = " SELECT about.image FROM about WHERE `about`.`id` = '" . $_GET["id"] . "' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (!empty($row["image"])) {
    unlink("../uploads/about/" . $row["image"]);
  }

  $sql = " DELETE FROM about WHERE id= '" . $_GET["id"] . "' ";

  if ($conn->query($sql) === TRUE) {
    $_SESSION["success"] = " Record deleted successfully . ";
  } else {
    $_SESSION["error"] = "Error deleting record: " . $conn->error;
  }
  header("location: ./aboutcontentchange.php");
  die();
}
?>

<section class="page_nav">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul>
          <li>
            <a href="./content_change.php">Home</a>
          </li>
          <li>
            <a href="./articles_blogschange.php">Articles and Blogs</a>
          </li>
          <li>
            <a href="./newscontentchange.php">News</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>


<section>
  <div class="about_main">
    <div class="heading-text">
      <p>About Content Change</p>
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
      <div class="contact_form">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Please enter the title here" vaule="<?php echo (($about_data['name'] != "") ? $about_data['name'] : ""); ?>" required>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <?php if (!empty($about_data["image"])) { ?>
              <img alt="Image placeholder" src="../uploads/about/<?= $about_data["image"]; ?>" class="about_img">
              <input type="hidden" name="image_name" id="image_name" class="form-control" placeholder="Please the select the image in jpg/png" value="<?php echo $about_data['image']; ?>">
            <?php } ?>
            <input type="file" name="image" id="image" accept="image/*" class="form-control" placeholder="Please elect the image in jpg/png">
            <h5 style="color: red;">*Please upload the image in jpg/png format</h5>
          </div>
          <div class="form-group">
            <label for="message">Description</label>
            <textarea name="message" id="message" class="form-control" placeholder="Please enter the description here" value="<?php echo (($about_data['message'] != "") ? $about_data['message'] : ""); ?>" required></textarea>
          </div>
          <?php
          if (!empty($about_data['id'])) {
          ?>
            <button class="aboutbtn" name="update-about" value="add-about">Update About</button>
          <?php } else { ?>
            <button class="aboutbtn" name="add-about" value="add-about">Add About</button>
          <?php } ?>
          
        </form>
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
                <th scope="col">Message</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = " SELECT about.* FROM about ORDER BY `about`.`id` DESC ";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
              ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                      <div class="media align-items-center">
                        <img alt="Image placeholder" src="../uploads/about/<?= $row["image"]; ?>" class="about_img">
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?= $row["name"]; ?></span>
                        </div>
                      </div>
                    </td>
                    <td style="width:100%;">
                      <p><?= $row["message"]; ?></p>
                    </td>
                    <td>
                      <a href="./aboutcontentchange.php?edit=<?= $row["id"]; ?>" class="content loginbtn" style="color:whitesmoke; text-decoration:none;"> Edit </a> |
                      <a href="./aboutcontentchange.php?id=<?= $row["id"]; ?>" class="content loginbtn" style="color:whitesmoke; text-decoration:none;"> Delete </a>
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
include("../includes/admin/footer.php");
?>