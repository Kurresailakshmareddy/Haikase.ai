<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Haikase.AI</title>
    <link rel="shortcut icon" href="./images/footerlogo1.png" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:ital,wght@1,100&family=Roboto&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
</head>

<body>
    <div class="dark-theme">

        <section id="banner2">
            <a href="./home.php">
                <img src="./images/logo3.png" class="logo" alt="logo" />
            </a>

            <div class="banner2-text">
                <h1>HAIKASE.AI</h1>
                <p>Nearer to Future</p>
                <div class="banner-btn">
                    <a href="./feedback_form.php"><span></span>Be a Member</a>
                    <a href="./gethelp.php"><span></span>Get Help</a>
                </div>
            </div>
        </section>


        <div id="sideNav">
            <div class="container">
                <button class="theme-toggle" id="theme-toggle">
                    <span class="sun-icon" id="sun-icon">☀️</span>
                </button>
            </div>
            <nav>
                <ul>
                    <li><a href="./home.php">HOME</a></li>
                    <li><a href="./about.php">ABOUT</a></li>
                    <li><a href="./services.php">SERVICES</a></li>
                    <li><a href="./news.php">NEWS</a></li>
                    <li><a href="./blogs.php">ARTICLE AND BLOGS</a></li>

                    <?php
                    if (isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"])) {
                        echo '<li><a href="./content_change.php">CONTENT CHANGE</a></li>';
                        echo '<li><a href="./content_view.php">CONTENT VIEW</a></li>';
                        echo '<li><a href="./logout.php">LOGOUT</a></li>';
                    } else {
                        echo '<li><a href="./feedback_form.php">BE A MEMBER</a></li>';
                        echo '<li><a href="./gethelp.php">GET HELP</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>

        <div id="menuBtn">
            <img src="./images/menu.png" id="menu" alt="img" />
        </div>
    </div>
    <script src="JavaScript/script.js"></script>
</body>
</html>