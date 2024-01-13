<?php

require("../includes/config.php");

session_destroy();
$conn->close();

header("location: ./index.php");
die();
?>