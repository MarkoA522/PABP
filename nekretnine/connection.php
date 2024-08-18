<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "nekretnine";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Greska prilikom povezivanja sa bazom podataka.");
}
?>