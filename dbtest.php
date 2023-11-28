<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host="194.5.157.208";
$usr="aldas_";
$passwd="Holzma100";
$dbname="viktorina";
// Create connection
$conn = mysqli_connect($host, $usr, $passwd, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: ");
}
echo "Connected successfully";
mysqli_close($conn);
?>