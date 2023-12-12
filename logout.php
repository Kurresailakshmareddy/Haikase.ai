<?php

require("config.php");

session_destroy();
$conn->close();

header("location: login.php");
die();
?>