<?php
session_start();
session_regenerate_id() ;
ob_start() ;

/*ini_set("display_errors", 1);
error_reporting(E_ALL);
error_reporting(0);
*/


// $servername= 'localhost';
// $username= 'unn_w21037098';
// $password = 'OMsai@123';
// $dbname = 'unn_w21037098';

$servername= 'localhost';
$username= 'root';
$password = '';
$dbname = 'test';

// $servername= 'localhost';
// $username= 'haikase';
// $password = 'haikase.AI@123.ai';
// $dbname = 'haikase';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
