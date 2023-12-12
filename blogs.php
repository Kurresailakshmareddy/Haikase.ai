<?php
include("includes/header.php");

echo '<div class="blog-text">
        <p>ARTICLES AND BLOGS</p>
      </div>';

$sql = " SELECT article.* FROM article ORDER BY `article`.`id` DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
?>

        <section id="blog">
            <div class="blog-box">
                <div class="blog-img">
                    <img alt="Image placeholder" style="width: 300px; height:300px;" src="./uploads/article/<?= $row["image"]; ?>">
                </div>
                <div class="blog_features">
                    <div class="blog_features-desc">
                        <p>
                            <?= $row["message"]; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

<?php
        $i++;
    }
} else {
    echo "<tr><td colspan='3'>No results</td></tr>";
}
?>

<?php
include("includes/footer.php");
?>