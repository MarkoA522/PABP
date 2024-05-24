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
    <title>Ponude</title>
    <style>
        h1 {
            text-align: center;
            margin: 2%;
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
        card {
            max-width: 30%;
        }
        section {
            
        }
        card-container {
            max-width: 200px;
        }
        card-text {
            padding: 0p;

        }
    </style>
</head>
<body>
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
  <div>
    <h1>Ponude</h1>
  </div>
  <div style="text-align:center">
    <a href="addoffer.php">
        <button type="submit" style="height: 50px; width: 300px; margin: 0 auto; background-color: green; margin-bottom: 30px">Kreiraj oglas</button>
    </a>
  </div>
  <div class="container-sm">
    <div class="card-container" style="text-align: center;">
    <?php
    
    $query = $conn->query("SELECT * FROM posts");

    while($data = $query->fetch_object()) {
        echo '<div class="card" style="background-color: silver;">';
           echo '<a href="offerinfo.php">';
           echo '<div class="row">';
              echo '<div class="col-3">';
                 echo '<img src="IMG/' . $data->naslovnaslika . '" alt="House 1" class="card-image">';
              echo '</div>';
              echo '<div class="col-4" style="text-align: left;">';
                 echo '<h2 class="card-title">' . $data->naslov . '</h2>
                 <p class="card-text">Lokacija: ' . $data->lokacija . '</p>
                 <p class="card-text">Grejanje: ' . $data->tipgrejanja . '</p>
                 <p class="card-text">Broj soba: ' . $data->brojsoba . '</p>
                 <p class="card-text">' . $data->povrsina . 'm²</p>
                 <p class="card-price">' . $data->cena . 'EUR</p>';
              echo '</div>';
           echo '</div>';
           echo '</a>';
        echo '</div>';
    }
    ?>
    
        <div class="card">
            <img src="house2.jpg" alt="House 2" class="card-image">
            <h2 class="card-title">Modern Apartment</h2>
            <p class="card-location">Location: Metropolis</p>
            <p class="card-price">$250,000</p>
        </div>
        <div class="card">
            <img src="house3.jpg" alt="House 3" class="card-image">
            <h2 class="card-title">Cozy Cottage</h2>
            <p class="card-location">Location: Rivertown</p>
            <p class="card-price">$200,000</p>
        </div>
    </div>
  </div>

<script src="script.js"></script>
</body>
</html>