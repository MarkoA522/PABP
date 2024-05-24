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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["login"])) {
            $email = $_POST["email"];
            $pass = $_POST["password"];

            //require_once "connection.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if(password_verify($pass, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match!</div>";
            }
        }
        ?>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Login</h2>
                <form action="" method="post">
                <div class="form-group">
                <label for="email">E-mail adresa:</label>
                <input type="email" placeholder="Unesite email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Lozinka:</label>
                <input type="password" placeholder="Unesite lozinku" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
            
        </form>
        <div class="text-center mt-3">
            <p>Nemate nalog? Registrujte se <a href="register.php">ovde</a>
            </p>
        </div>
        

    </div>
</body>
</html>