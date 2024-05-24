<?php
include "connection.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Nekretnine</title>
</head>
<body class="body">
  
  <nav class="navbar">
        <div class="brand-title">Nekretnine</div>
        <a href="javascript:void(0);" class="toggle-button" onclick="toggleNavbar()">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links" id="navbarLinks">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a>
            </ul>
        </div>
    </nav>

    
    <script src="script.js"></script>
    
    
    
</body>
</html>

