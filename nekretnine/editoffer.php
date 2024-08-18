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
        window.onload = function() {
            prikaziCenu();
        }
    </script>
    <title>Ažuriranje nekretnine</title>
</head>
<body class="body">
  <?php
  if (!isset($_POST["post_id"])) {
    echo "nije postavljen";
  }
  $post_id = intval($_POST["post_id"]);
  
  $sqlExistingPost = "SELECT * FROM posts WHERE id = $post_id";
  $sqlResult = $conn->query($sqlExistingPost);
  $data = $sqlResult->fetch_object();

  if(isset($_POST["ažuriraj"])) {
    
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
        $sql = "UPDATE posts SET naslov=?, tip=?, opis=?, lokacija=?, ulica=?, brojulice=?, povrsina=?, brojsoba=?, tipgrejanja=?, internet=?, telefonskalinija=?, kablovska=?, brojspratova=?, stanjenekretnine=?, cena=?, naslovnaslika=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssiiissssisdsi", $naslov, $tiptransakcije, $opis, $lokacija, $ulica, $brojulice, $povrsina, $brojsoba, $tipgrejanja, $internet, $telefonskalinija, $kablovska, $brojspratova, $stanjenekretnine, $cena, $naslovnaslika, $post_id);
            mysqli_stmt_execute($stmt);
        
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<div class='alert alert-success'>Oglas je uspešno ažuriran!</div>";
                header("Location: ./offers.php");
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
        

<h2 class="card-title">Ažuriranje oglasa</h2>
<br>
<form action="editoffer.php" method="post">
    <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
    <div class="form-group">
        <label for="naslov">Naslov oglasa:</label>
        <input type="text" value="<?php echo "$data->naslov"; ?>" placeholder="Unesite naslov" name="naslov" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="opis">Opis:</label>
        <textarea name="opis" id="opis" placeholder="Unesite opis" style="min-height: 50px;"class="form-control"><?php echo "$data->opis";?></textarea>
    </div>
    <div class="form-group">
        <label for="Lokacija">Lokacija:</label>
        <input type="text" placeholder="Unesite lokaciju" value="<?php echo "$data->lokacija"; ?>" name="lokacija" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ulica">Ulica:</label>
        <input type="text" placeholder="Unesite naziv ulice" value="<?php echo "$data->ulica"; ?>" name="ulica" class="form-control" required>
        <label for="brojulice">Broj ulice:</label>
        <input type="text" placeholder="Unesite broj ulice" value="<?php echo "$data->brojulice"; ?>" name="brojulice" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="povrsina">Površina:</label>
        <input type="text" placeholder="Unesite površinu" value="<?php echo"$data->povrsina"; ?>" name="povrsina" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="brojsoba">Broj soba:</label>
        <select name="brojsoba" id="brojsoba" selected="<?php echo "$data->brojsoba"; ?>" class="form-select" required>
            <?php
            for($i = 1; $i <= 15; $i++){
                $selectedBrSoba = ($data->brojsoba == $i) ? 'selected' : '';
                echo "<option value='$i' $selectedBrSoba>$i</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tipgrejanja">Izaberite tip grejanja:</label>
        <select name="tipgrejanja" id="tipgrejanja" value="<?php echo "$data->tipgrejanja"; ?>" class="form-select" required>
            <?php
            $tipovigrejanja = ["Struja", "Gas", "Toplotne pumpe", "Ostalo"];
            foreach ($tipovigrejanja as $tip){
                $selectedTipGrejanja = ($data->tipgrejanja == $tip) ? 'selected' : '';
                echo "<option value='$tip' $selectedTipGrejanja>$tip</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        
    <label for="internet">Pristup internetu:</label>
        <select name="internet" id="internet" class="form-select" required>
            <?php
            $internet = ["Ima", "Nema"];
            foreach ($internet as $net){
                $selectedInternet = ($data->internet == $net) ? 'selected':'';
                echo "<option value='$net' $selectedInternet>$net</option>";
            }
            ?>
        </select>
        <label for="telefonskalinija">Pristup telefonskoj liniji:</label>
        <select name="telefonskalinija" id="telefonskalinija" class="form-select" required>
            <?php
            $linije = ["Ima", "Nema"];
            foreach ($linije as $linija){
                $selectedLinija = ($data->telefonskalinija == $linija) ? 'selected':'';
                echo "<option value='$linija' $selectedLinija>$linija</option>";
            }
            ?>
        </select>
        <label for="kablovska">Pristup kablovskoj:</label>
        <select name="kablovska" id="kablovska" class="form-select" required>
            <?php
            $kablovska = ["Ima", "Nema"];
            foreach ($kablovska as $kab){
                $selectedKablovska = ($data->kablovska == $kab) ? 'selected':'';
                echo "<option value='$kab' $selectedKablovska>$kab</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="brojspratova">Unesite broj spratova:</label>
        <select name="brojspratova" id="brojspratova" value="<?php echo "$data->brojspratova";?>" class="form-select" required>
            <?php
            for ($i = 1; $i <= 15; $i++) {
                $selectedBrSprat = ($data->brojspratova == $i) ? 'selected':'';
                echo "<option value='$i' $selectedBrSprat>$i</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="stanjenekretnine">Stanje nekretnine:</label>
        <select name="stanjenekretnine" id="stanjenekretnine" value="<?php echo "$data->stanjenekretnine";?>" class="form-select" required>
            <?php
            $stanja = ["Uobičajeno", "Novo", "U izgradnji", "Renovirano", "Potrebno renoviranje", "Luksuzno"];
            foreach ($stanja as $stanje) {
                $selectedStanje = ($data->stanjenekretnine == $stanje) ? 'selected':'';
                echo "<option value='$stanje' $selectedStanje>$stanje</option>";
            }
            ?>    
        </select>
    </div>
    <div class="form-group">
        <label for="tip_transakcije">Tip transakcije:</label>
        <select name="tip_transakcije" id="tip_transakcije" class="form-select" onchange="prikaziCenu()" required>
            <?php
            $tipovi = ["Prodaja", "Iznajmljivanje"];
            foreach ($tipovi as $tip) {
                $selectedTip = ($data->tip == $tip) ? 'selected':'';
                echo "<option value='$tip' $selectedTip>$tip</option>";            
            }
            ?>
        </select>
    </div>
    <div id="cena_prodaja" class="form-group" style="display:none; margin-bottom: 20px;">
        <label for="cena_prodaja">Cena (EUR):</label>
        <input type="text" value="<?php echo "$data->cena";?>" placeholder="Unesite cenu" name="cena_prodaja" class="form-control">
    </div>
    <div id="cena_iznajmljivanje" class="form-group" style="display:none; margin-bottom: 20px;">
        <label for="cena_iznajmljivanje">Cena mesečno (EUR):</label>
        <input type="text" value="<?php echo "$data->cena";?>" placeholder="Unesite cenu mesečno" name="cena_iznajmljivanje" class="form-control">
    </div>

    <label for="naslovnaslika">Naslovna slika:</label>
    <select name="naslovnaslika" id="naslovnaslika" class="form-select">
        <?php
        $slike = ["kuca.jpg", "kuca2.jpg", "monta.jpg", "planinskakuca.jpg", "montaznakucaa.jpg"];
        $slikeKey = ["kuca.jpg"=>"Kuća 1", "kuca2.jpg"=>"Kuća 2", "monta.jpg"=>"Monta", "planinskakuca.jpg"=>"Planinska kuća", "montaznakucaa.jpg"=>"Montažna kuća"];
        foreach ($slike as $slika) {
            
            $selectedSlika = ($data->naslovnaslika == $slika) ? 'selected':'';
            echo "<option value='$slika' $selectedSlika>$slikeKey[$slika]</option>";
        }
        ?>
    <input  type="submit" style="width: 70%; margin-top: 25px; margin-left: 15%;" value="Ažuriraj oglas" name="ažuriraj" class="btn btn-primary">
    
</form>
</div>
</div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>