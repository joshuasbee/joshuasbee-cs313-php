<?php
  require "../db/dbConnect.php";
  $db = get_db();
  if(isset($_POST['login'])){
    //verify that the login worked

    //then go to the other page
    //header("Location: http://www.example.com/another-page.php");
    //exit();
  }

  if(isset($_POST['signup'])){
    //add email to database
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $psql = "INSERT INTO users (email, password) VALUES ($email, $pass)";
    $stmt= $pdo->prepare($psql);
    $stmt->execute([$email, $pass]);
    echo 'inserted';
    //header("Location: ./signup.php");
    //exit();
  }


?>