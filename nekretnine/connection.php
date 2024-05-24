<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_register";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Greska prilikom povezivanja sa bazom podataka.");
}
?>