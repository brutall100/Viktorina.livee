<?php

$dbhost = '194.5.157.208';
$dbuser = 'aldas_';
$dbpassword = 'Holzma100';
$dbname = 'viktorina';
$port = 3306;

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>