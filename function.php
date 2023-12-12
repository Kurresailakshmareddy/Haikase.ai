<?php
require_once('class.phpmailer.php');

function check_login()
{
    if (!isset($_SESSION["admin_id"]) && empty($_SESSION["admin_id"])) {
        header("location: login.php");
        die();
    }
}

function check_logout()
{
    if (isset($_SESSION["admin_id"]) && !empty($_SESSION["admin_id"])) {
        header("location:home.html");
        die();
    }
}
