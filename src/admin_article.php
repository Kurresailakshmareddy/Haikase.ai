<?php

include("includes/header.php");

if (isset($_GET["id"])) {

    $sql = " SELECT adminarticle.image FROM adminarticle WHERE `adminarticle`.`id` = '" . $_GET["id"] . "' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!empty($row["image"])) {
        unlink("./uploads/news/" . $row["image"]);
    }

    $sql = " DELETE FROM adminarticle WHERE id= '" . $_GET["id"] . "' ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = " Record deleted successfully . ";
    } else {
        $_SESSION["error"] = "Error deleting record: " . $conn->error;
    }
    header("location: admin_article.php");
    die();
}
?>

<section class="page_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <a href="./articles_blogschange.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section>

    <?php
    if (isset($_SESSION["success"])) {
        echo '<div class="success">' . $_SESSION["success"] . '</div>';
        unset($_SESSION["success"]);
    } elseif (isset($_SESSION["error"])) {
        echo '<div class="error">' . $_SESSION["error"] . '</div>';
        unset($_SESSION["error"]);
    }
    ?>

    <div class="news_main">
        <div class="heading-text">
            <p> Admin Article and Blogs View </p>
        </div>

        <hr>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Data Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = " SELECT adminarticle.* FROM adminarticle ORDER BY `adminarticle`.`id` DESC ";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <img alt="Image placeholder" src="./uploads/article/<?= $row["image"]; ?>" class="about_img">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        <?= $row["name"]; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width:70%;">
                                            <p>
                                                <?= $row["message"]; ?>
                                            </p>
                                        </td>
                                        <td style="width:50%;">
                                            <p>
                                                <?= $row["datetime"]; ?>
                                            </p>
                                        </td>
                                        <td>
                                            <a href="admin_article.php?id=<?= $row["id"]; ?>" class="content loginbtn"> Delete </a>
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