<?php
include("includes/header.php");

echo '<div class="about-text">
        <p>Why Choose Us</p>
      </div>';

$sql = " SELECT about.* FROM about ORDER BY `about`.`id` DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
?>

        <body>
            <section id="about">
                <div class="about-box">
                    <div class="aboutfeatures">
                        <div class="aboutfeatures-desc">
                            <p>
                                <span><?= $row["name"]; ?></span>
                                <?= $row["message"]; ?>
                            </p>
                        </div>
                    </div>
                    <div class="about-img">
                        <img alt="Image placeholder" src="./uploads/about/<?= $row["image"]; ?>">
                    </div>
                </div>
            </section>
            <script src="JavaScript/script.js"></script>
        </body>

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