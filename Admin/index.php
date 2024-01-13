<?php
include("../includes/admin/header.php");

require("./function.php");

if (isset($_POST["login"])) {

    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $password = md5($password);

    $sql = " SELECT * FROM `admin` WHERE `email` = '$email' AND password='$password'";

    $query = $conn->query($sql);


    if ($query->num_rows > 0) {
        $arr = $query->fetch_assoc();
        if ($arr['email'] === $email && $arr['password'] === $password) {
            $_SESSION["admin_id"] = $arr["id"];
            $_SESSION["admin_name"] = $arr["name"];
            header("location: ./home.php");
            die();
        } else {
            $_SESSION["error"] = "Incorrect User name or password :( ";
        }
    } else {
        $_SESSION["error"] = "Incorrect User name or password :( ";
    }
}
?>

<!-- <section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Login</h2>
            </div>
        </div>
    </div>
</section> -->

<section>

    <div class="login_container">
        <div class="login_form">
            <div class="login-text">
                <p>Login Here</p>
            </div>
            <form action="" method="post">
                <?php
                if (isset($_SESSION["error"])) {
                    echo '<div class="error"> ' . $_SESSION["error"] . ' </div>';
                    unset($_SESSION["error"]);
                }
                ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Please enter your email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Please enter your password" name="password" required>
                </div>

                <div class="login form-group">
                    <button type="submit" class="loginbtn" name="login" value="login">Login</button>
                    <button class="btn"><a href="./forgotten_password.php" style="color:white; text-decoration:none;">Forgotten Password?</a></button>
                </div>
            </form>
        </div>

    </div>

</section>

<?php
include("../includes/admin/footer.php");
?>