<?php
include "connection.php";
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registracija</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    
  </head>
<body>

<div class="container">
  <?php
  if(isset($_POST["submit"])) {
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $email = $_POST["email"];
    $korisnickoIme = $_POST["korisnicko_ime"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeat_password"];

    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    if (empty($ime) OR empty($prezime) OR empty($email) OR 
    empty($korisnickoIme) OR empty($password) OR empty($repeatPassword)) {
      array_push($errors,"All fields are required");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors,"Email is not valid");
    }
    if(strlen($password)<8) {
      array_push($errors,"Password must be at least 8 characters long!");
    }
    if($password!==$repeatPassword) {
      array_push($errors,"Password does not match");
    }
    require_once "connection.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0){
      array_push($errors,"Email already exists!");
    }
    if (count($errors)>0) {
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }
    } else {
       
      $sql = "INSERT INTO users (ime, prezime, email, korisnicko_ime, password) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
      if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $ime, $prezime, $email, $korisnickoIme, $passwordHash);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>You have been registered successfully!</div>";
        
      } else {
        die("Something went wrong!");
      }

    }  

  }
  ?>
  <div class="card">
      <div class="card-body">
          <h2 class="card-title">Registracija</h2>
          <form action="register.php" method="post">
            <div class="form-group">
              <label for="ime">Ime:</label>
              <input type="text" class="form-control" id="ime" name="ime" placeholder="Unesite ime" required>
            </div>
            <div class="form-group">
              <label for="prezime">Prezime:</label>
              <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesite prezime" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail adresa:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Unesite email" required>
            </div>
            <div class="form-group">
              <label for="korisnicko_ime">Korisničko ime:</label>
              <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="Unesite korisnicko ime" required>
            </div>
            <div class="form-group">
              <label for="password">Lozinka:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Unesite lozinku" required>
            </div>
            <div class="form-group">
              <label for="repeatPassword">Ponovite lozinku:</label>
              <input type="password" class="form-control" id="repeatPassword" name="repeat_password" placeholder="Ponovo unesite lozinku" required>
            </div>
            <div class="form-btn">
              <input type="submit" class="btn btn-primary" value="Registruj se" name="submit">
            </div>
          </form>
<div>
      <p>Već imate nalog? Ulogujte se <a href="login.php">ovde</a>
      </p>
    </div>
</div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>