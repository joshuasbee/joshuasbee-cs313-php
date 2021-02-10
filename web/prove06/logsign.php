<?php
  require "../db/dbConnect.php";
  $db = get_db();
  if(isset($_GET['login'])){
    //verify that the login worked

    //then go to the other page
    //header("Location: http://www.example.com/another-page.php");
    //exit();
  }

  if(isset($_GET['signup'])){
    //add email to database
    $username = $_GET['username'];
    echo $username;
    // $sql = "INSERT INTO users (email, password) VALUES ()";
    // $stmt= $pdo->prepare($sql);
    // $stmt->execute([$name, $surname, $sex]);
    //header("Location: ./signup.php");
    //exit();
  }


?>