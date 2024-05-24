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
  <?php
  if(isset($_POST["submit"])) {
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
    $cena = $_POST["cena"];
    $naslovnaslika = $_POST["naslovnaslika"];

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
         
        $sql = "INSERT INTO posts (naslov, $id_user, opis, lokacija, ulica, brojulice,
        povrsina, brojsoba, tipgrejanja, internet, telefonskalinija,kablovska,
        brojspratova, stanjenekretnine, cena, naslovnaslika) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
          mysqli_stmt_bind_param($stmt, "sssssssssssssssssssss", $naslov, $id_user, $opis, $lokacija, $ulica, $brojulice,
          $povrsina, $brojsoba, $tipgrejanja, $internet, $telefonskalinija,$kablovska,
          $brojspratova, $stanjenekretnine, $cena, $naslovnaslika);
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'>You have created a post successfully!</div>";
          
        } else {
          die("Something went wrong!");
        }
  
      }  
  
    }
    ?>


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
    <div class="container" style="margin-top: 40px;">
        <section class="wrapper-main" style="padding: 30px;">
                <h2>Kreiraj oglas</h2>
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
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="cena">Cena(EUR):</label>
                        <input type="text" placeholder="Unesite cenu" name="cena" class="form-control" required>
                    </div>
                    <label for="naslovnaslika">Naslovna slika:</label>
                    <select name="naslovnaslika" id="naslovnaslika" class="form-select">
                            <option value="kuca.jpg">slika kuce 1</option>
                            <option value="kuca2.jpg">slika kuce 2</option>
                            <option value="monta.jpg">slika kuce 3</option>
                            <option value="planinskakuca.jpg">slika kuce 4</option>
                    <div class="form-btn" style="text-align: center; padding: 30px;">
                        <input type="submit" value="Kreiraj" style="width: 70%;" name="kreiraj" class="btn btn-primary">
                    </div>
                </form>
                
            
        </section>
    </div>
    
    <script src="script.js"></script>
</body>
</html>