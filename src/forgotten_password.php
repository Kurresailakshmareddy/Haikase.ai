<?php
include("includes/header.php");


require("function.php");

if (isset($_POST["login"])) {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $password = md5($password);

    $sql = " UPDATE `admin` SET `password` = '$password'   WHERE `email`= '$email' ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = " Password Updated successfully . ";
    } else {
        $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<section>

    <div class="login_container">
        <div class="login_form">
            <div class="login2-text">
                <p>Forgotten Password</p>
            </div>
            <form action="./forgotten_password.php" method="post">
                <?php
                if (isset($_SESSION["success"])) {
                    echo '<div class="success">' . $_SESSION["success"] . '</div>';
                    unset($_SESSION["success"]);
                } elseif (isset($_SESSION["error"])) {
                    echo '<div class="error">' . $_SESSION["error"] . '</div>';

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

                <div class="form-group">
                    <button type="submit" name="login" value="login" class="btn">Update Password</button>
                    <button class="loginbtn"><a href="./login.php" style="color:#fff; text-decoration:none;">Log In</a></button>
                </div>
            </form>
        </div>

    </div>


    <?php
    include("includes/footer.php");
    ?>