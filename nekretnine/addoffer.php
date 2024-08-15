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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <script>
        function prikaziCenu() {
            var tipTransakcije = document.getElementById('tip_transakcije').value;
            var cenaProdaja = document.getElementById('cena_prodaja');
            var cenaIznajmljivanje = document.getElementById('cena_iznajmljivanje');

            if (tipTransakcije === 'Prodaja') {
                cenaProdaja.style.display = 'block';
                cenaIznajmljivanje.style.display = 'none';
            } else if (tipTransakcije === 'Iznajmljivanje') {
                cenaProdaja.style.display = 'none';
                cenaIznajmljivanje.style.display = 'block';
            } else {
                cenaProdaja.style.display = 'none';
                cenaIznajmljivanje.style.display = 'none';
            }
        }
    </script>
    <title>Nekretnine</title>
</head>
<body class="body">
  <?php
  
  if(isset($_POST["kreiraj"])) {
    $id_user = $_SESSION["id"];
    $naslov = $_POST["naslov"];
    $opis = $_POST["opis"];
    $lokacija = $_POST["lokacija"];
    $ulica = $_POST["ulica"];
    $brojulice = $_POST["brojulice"];
    $povrsina = $_POST["povrsina"];
    $brojsoba = $_POST["brojsoba"];
    $tipgrejanja = $_POST["tipgrejanja"];
    $internet = $_POST["internet"];
    $telefonskalinija = $_POST["telefonskalinija"];
    $kablovska = $_POST["kablovska"];
    $brojspratova = $_POST["brojspratova"];
    $stanjenekretnine = $_POST["stanjenekretnine"];
    $naslovnaslika = $_POST["naslovnaslika"];

    $tiptransakcije = $_POST["tip_transakcije"];
    $cena = 0;

    if($tiptransakcije == "Prodaja") {
        $cena = $_POST["cena_prodaja"];
    } elseif ($tiptransakcije == "Iznajmljivanje") {
        $cena = $_POST["cena_iznajmljivanje"];
    }

    $errors = array();

    if (empty($naslov) OR empty($lokacija) OR empty($ulica) OR 
    empty($brojulice) OR empty($povrsina) OR empty($brojsoba) OR empty($tipgrejanja) OR 
    empty($brojspratova) OR empty($stanjenekretnine) OR empty($cena)) {
      array_push($errors,"All necessary fields are required!");
    }
    

    if (count($errors)>0) {
        foreach ($errors as $error) {
          echo "<div class='alert alert-danger'>$error</div>";
        }
      } else {
         
        $sql = "INSERT INTO posts (id_user, naslov, tip, opis, lokacija, ulica, brojulice, povrsina, brojsoba, tipgrejanja, internet, telefonskalinija, kablovska, brojspratova, stanjenekretnine, cena, naslovnaslika) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "issssssisssiiisds", $id_user, $naslov, $tiptransakcije, $opis, $lokacija, $ulica, $brojulice, $povrsina, $brojsoba, $tipgrejanja, $internet, $telefonskalinija, $kablovska, $brojspratova, $stanjenekretnine, $cena, $naslovnaslika);
            mysqli_stmt_execute($stmt);
            
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<div class='alert alert-success'>Oglas je uspešno kreiran!</div>";
            } else {
                echo "<div class='alert alert-danger'>Došlo je do greške prilikom kreiranja oglasa.</div>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "<div class='alert alert-danger'>Priprema SQL upita nije uspela.</div>";
        }
        mysqli_close($conn); // 16
        
  
      }  
  
    }
    ?>


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
    <div class="card-container" style="margin-top: 40px;">
        <div class="card mx-auto" style="max-width: 40%;">
            <div class="card-body">
        

<h2 class="card-title">Kreiranje oglasa</h2>
<br>
<form action="addoffer.php" method="post">
    <div class="form-group">
        <label for="naslov">Naslov oglasa:</label>
        <input type="text" placeholder="Unesite naslov" name="naslov" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="opis">Opis:</label>
        <textarea name="opis" id="opis" placeholder="Unesite opis" style="min-height: 50px;"class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="Lokacija">Lokacija:</label>
        <input type="text" placeholder="Unesite lokaciju" name="lokacija" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ulica">Ulica:</label>
        <input type="text" placeholder="Unesite naziv ulice" name="ulica" class="form-control" required>
        <label for="brojulice">Broj ulice:</label>
        <input type="text" placeholder="Unesite broj ulice" name="brojulice" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="povrsina">Površina:</label>
        <input type="text" placeholder="Unesite površinu" name="povrsina" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="brojsoba">Broj soba:</label>
        <select name="brojsoba" id="brojsoba" class="form-select" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tipgrejanja">Izaberite tip grejanja:</label>
        <select name="tipgrejanja" id="tipgrejanja" class="form-select" required>
            <option value="struja">Struja</option>
            <option value="gas">Gas</option>
            <option value="toplotnepumpe">Toplotne pumpe</option>
            <option value="ostalo">Ostalo</option>
        </select>
    </div>
    <div class="form-group">
        
    <label for="internet">Pristup internetu:</label>
        <select name="internet" id="internet" class="form-select" required>
            <option value="ima">Ima</option>
            <option value="nema">Nema</option>
        </select>
        <label for="telefonskalinija">Pristup telefonskoj liniji:</label>
        <select name="telefonskalinija" id="telefonskalinija" class="form-select" required>
            <option value="ima">Ima</option>
            <option value="nema">Nema</option>
        </select>
        <label for="kablovska">Pristup kablovskoj:</label>
        <select name="kablovska" id="kablovska" class="form-select" required>
            <option value="ima">Ima</option>
            <option value="nema">Nema</option>
        </select>
    </div>
    <div class="form-group">
        <label for="brojspratova">Unesite broj spratova:</label>
        <select name="brojspratova" id="brojspratova" class="form-select" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
        </select>
    </div>
    <div class="form-group">
        <label for="stanjenekretnine">Stanje nekretnine:</label>
        <select name="stanjenekretnine" id="stanjenekretnine" class="form-select" required>
            <option value="uobičajeno">Uobičajeno</option>
            <option value="novo">Novo</option>
            <option value="u izgradnji">U izgradnji</option>
            <option value="renovirano">Renovirano</option>
            <option value="potrebno renoviranje">Potrebno renoviranje</option>
            <option value="luksuzno">Luksuzno</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tip_transakcije">Tip transakcije:</label>
        <select name="tip_transakcije" id="tip_transakcije" class="form-select" onchange="prikaziCenu()" required>
            <option value="">Izaberite</option>
            <option value="Prodaja">Prodaja</option>
            <option value="Iznajmljivanje">Iznajmljivanje</option>
        </select>
    </div>
    <div id="cena_prodaja" class="form-group" style="display:none; margin-bottom: 20px;">
        <label for="cena_prodaja">Cena (EUR):</label>
        <input type="text" placeholder="Unesite cenu" name="cena_prodaja" class="form-control">
    </div>
    <div id="cena_iznajmljivanje" class="form-group" style="display:none; margin-bottom: 20px;">
        <label for="cena_iznajmljivanje">Cena mesečno (EUR):</label>
        <input type="text" placeholder="Unesite cenu mesečno" name="cena_iznajmljivanje" class="form-control">
    </div>

    <label for="naslovnaslika">Naslovna slika:</label>
    <select name="naslovnaslika" id="naslovnaslika" class="form-select">
            <option value="kuca.jpg">Kuca 1</option>
            <option value="kuca2.jpg">Kuca 2</option>
            <option value="monta.jpg">Monta</option>
            <option value="planinskakuca.jpg">Planinska kuća</option>
            <option value="montaznakucaa.jpg">Montažna kuća</option>
    
    <input  type="submit" style="width: 70%; margin-top: 25px; margin-left: 15%;" value="Kreiraj oglas" name="kreiraj" class="btn btn-primary">
    
</form>
</div>
</div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>