<?php
include "connection.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Nekretnine</title>
</head>
<body class="body">
  
<div class="container" style="min-width: 100%;">
    
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="nekretnine.php">Nekretnine</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="offers.php">Ponude</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            
        </ul>
    </div>
</nav>
</div>    


    <?php

    if(isset($_GET["offer_id"])){
        $offer_id = intval($_GET["offer_id"]);
    
        $sql = "SELECT *
                FROM posts
                WHERE id = $offer_id";
        $query = $conn->query($sql);
        $data = $query->fetch_object();

        $user_id = intval($data->id_user);

        $sql2 = "SELECT *
                 FROM users
                 WHERE id = $user_id";
        $query2 = $conn->query($sql2);
        $data2 = $query2->fetch_object();
        
        echo "<div class='container' style='min-width:50%; margin-top:50px;'>
        <img src='IMG/".$data->naslovnaslika."' alt='Naslovna slika' style='max-width:100%;min-width: auto;'>
        </div>
        <div class='container' style='min-width:50%; margin-top:18px;'>
        <table class='table'>
        <tbody>
        <tr>
        <th>Podaci o vlasniku</th><td></td>
        <td></td><td></td>
        </tr>
        <tr>
        <td>Ime i prezime:</td><td>".$data2->ime." ".$data2->prezime."</td>
        <td>Kontakt:</td><td>".$data2->email."</td></tr>
    
        </tr>
        <tr>
        <td>Korisnicko ime:</td><td>".$data2->korisnicko_ime."</td>
        <td></td><td></td>
        </tbody>
        </table>
        </div>";
        ?>
        <div class="container" style="min-width:50%;">
        <?php
        echo "<table class='table'>
              <tbody>";
        
            echo "<tr>
                  <th>Podaci o nekretnini</th>
                  <th></th>
                  </tr>
                  <tr>
                  <td>Naslov:</td><td>".$data->naslov."</td>
                  </tr>
                  <tr>
                  <td>Transakcija:</td><td>".$data->tip."</td>
                  </tr>
                  <tr>
                  <td>Opis:</td><td>".$data->opis."</td>
                  </tr>
                  <tr>
                  <td>Lokacija:</td><td>".$data->lokacija."</td>
                  </tr>
                  <tr>
                  <td>Ulica:</td><td>".$data->ulica."</td>
                  </tr>
                  <tr>
                  <td>Broj ulice:</td><td>".$data->brojulice."</td>
                  </tr>
                  <tr>
                  <td>Površina:</td><td>".$data->povrsina."</td>
                  </tr>
                  <tr>
                  <td>Broj soba:</td><td>".$data->brojsoba."</td>
                  </tr>
                  <tr>
                  <td>Tip grejanja:</td><td>".$data->tipgrejanja."</td>
                  </tr>
                  <tr>
                  <td>Internet:</td><td>".$data->internet."</td>
                  </tr>
                  <tr>
                  <td>Telefonska linija:</td><td>".$data->telefonskalinija."</td>
                  </tr>
                  <tr>
                  <td>Kablovska:</td><td>".$data->kablovska."</td>
                  </tr>
                  <tr>
                  <td>Broj spratova:</td><td>".$data->brojspratova."</td>
                  </tr>
                  <tr>
                  <td>Stanje nekretnine:</td><td>".$data->stanjenekretnine."</td></tr>
                  ";
                   if ($data->tip === "Iznajmljivanje") {
                    echo "<tr>
                    <td>Cena/mesečno:</td><td>".$data->cena." EUR</td>
                    </tr>";
                  } else {
                    echo "<tr>
                    <td>Cena:</td><td>".$data->cena." EUR</td>
                    </tr>";
                  }

        
        echo "</tbody>
              </table>";
    } else {
        echo "Offer ID is not set";
        exit();
    }
    ?>
</div>

    <script src="script.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>