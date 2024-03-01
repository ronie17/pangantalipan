<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pangantalipan"; // Change the database name here

$con = mysqli_connect($host, $username, $password, $database);

if(!$con) {
    die("". mysqli_connect_error());
}
?>
