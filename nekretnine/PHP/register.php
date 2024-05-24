<?php

include_once("db.php");

$password = $_REQUEST["password"];
$paswordre = $_REQUEST["passwordre"];

if($password != $paswordre){
    die(header("Location: ../register.php?error=1"));
}
else{


    $ime = $_REQUEST["ime"];
    $prezime = $_REQUEST["prezime"];
    $email = $_REQUEST["email"];
    $about = $_REQUEST["about"];
    $priv = 0;

    $query = $mysqli->query("SELECT * FROM user WHERE email='$email'");
    $num = $query->num_rows;
    
    if($num > 0){
        die(header("Location: ../register.php?error=2"));
    }

    $statement = $mysqli->prepare("INSERT INTO user (ime, prezime, email, password, about, priv) VALUES (?, ?, ?, ?, ?, ?)");

    $statement->bind_param('sssssi', $ime, $prezime, $email, md5($password), $about, $priv);

    if($statement->execute()){
        header("Location: ../index.php?success=1");
    }
    else{
        die('Error: (' . $mysqli->errno . ')' . $mysqli->error);
    }






}










?>