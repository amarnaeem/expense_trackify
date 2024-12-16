<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$server = "localhost";
$username = "root";
$password = "";
$mydatabase = "trackify_db";

$conn = mysqli_connect($server, $username, $password, $mydatabase);

if (!$conn) {
    echo "Error: " . mysqli_connect_error();
}
