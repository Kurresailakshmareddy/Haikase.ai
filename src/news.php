<?php
include("includes/header.php");

echo '<div class="about-text">
        <p>NEWS</p>
      </div>';

$sql = " SELECT news.* FROM news ORDER BY `news`.`id` DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
?>

        <section id="news">
            <!-- <div class="news-text">
                <p>Lastest Updates</p>
            </div> -->
            <div class="news-box">
                <div class="news-img">
                    <img alt="Image placeholder" style="width: 200px; height:200px;" src="./uploads/news/<?= $row["image"]; ?>">
                </div>
                <div class="news_features">
                    <div class="news_features-desc">
                        <p>
                            <?= $row["description"]; ?>
                        </p>

                    </div>
                    <div class="news_features-desc">
                        <p>
                            <a href="./uploads/news/<?= $row["file"]; ?>" download><?= $row["file"]; ?></a>
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