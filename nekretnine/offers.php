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
    <title>Ponude</title>
    <style>
        th {
            text-align: center;
        }
        td {
            vertical-align: middle;
        }
        h1 {
            text-align: center;
            margin: 2%;
        }
        .custom-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        card {
            max-width: 30%;
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
  <div>
    <h1>Dostupne ponude</h1>
  </div>
  <div style="text-align:center">
    <a href="addoffer.php">
        <button type="submit" style="height: 50px; width: 300px; margin: 0 auto; background-color: green; margin-bottom: 30px">Kreiraj oglas</button>
    </a>
  </div>
  <form action="offers.php" method="post">
<div class="form-group mx-auto" style="max-width: 20%;">
    <label for="filter">Filter:</label>
    <select name="filter" id="filter" class="form-select">
        <option value="">Sve</option>
        <option value="Prodaja">Prodaja</option>
        <option value="Iznajmljivanje">Iznajmljivanje</option>
    </select>
    <input type="submit" style="max-width: 60%; margin-top: 25px; margin-left: 40%;" value="Filtriraj" name="filtriraj" class="btn btn-primary">
</div>
</form>
  

  
<?php
$query = "SELECT * FROM posts";

if (isset($_POST['filter']) && !empty($_POST['filter'])) {
    $filter = $conn->real_escape_string($_POST['filter']);
    $query .= " WHERE tip = '$filter'";
}

$result = $conn->query($query);

echo "<table class='table'>
    <th></th>
    <th></th>
    <th>Korisnik</th>
    <th>Naslov</th>
    <th>Transakcija</th>
    <th>Cena</th>
    <th>Stanje</th>
    <th>Lokacija</th>
    <th>Grejanje</th>
    <th>Broj soba</th>
    <th>Površina</th>";

    
    if(isset($_GET["obrisi"])){
        $postId = $_GET["id"];
        $sqldelete = "DELETE FROM posts WHERE id = $postId";
        $postQuery = $conn->query($sqldelete);
        header("Location: offers.php");
    }

while ($data = $result->fetch_object()) {
    

    echo "<tr style='text-align: center;'>";
    $userQuery = "SELECT * FROM users WHERE id = $data->id_user";
    $userResult = $conn->query($userQuery);
    $user = $userResult->fetch_object();

    echo '<td><a href="offerinfo.php?offer_id=' . $data->id . '"><img src="IMG/' . $data->naslovnaslika . '" alt="House image" class="custom-img"></a></td>';
    if ($data->id_user == $_SESSION["id"]){
        echo '
            <td>
                <form style="margin-bottom: 10px;" action="editoffer.php" method="post">
                    <input type="hidden" name="post_id" value="'.htmlspecialchars($data->id).'">
                    <button type="submit" class="btn btn-success">ažuriraj</button>
                </form>
                <form action="offers.php" method="get">
                    <input type="hidden" name="id" value="'.$data->id.'">
                    <button type="submit" class="btn btn-danger" name="obrisi">obriši</button>
                </form>
            </td>
            ';
    } else {
        echo '<td></td>';
    }
    echo '<td>' . $user->korisnicko_ime . '</td>';
    echo '<td>' . $data->naslov . '</td>';
    echo '<td><b>' . $data->tip . '</b></td>';
    echo '<td>' . $data->cena . 'EUR</td>';
    echo '<td>' . $data->stanjenekretnine . '</td>';
    echo '<td>' . $data->lokacija . '</td>';
    echo '<td>' . $data->tipgrejanja . '</td>';
    echo '<td>' . $data->brojsoba . '</td>';
    echo '<td>' . $data->povrsina . 'm²</td>';
    echo "</tr>";
}
echo "</table>";


?>
    
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
