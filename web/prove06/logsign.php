<?php
  require "../db/dbConnect.php";
  $db = get_db();
  if(isset($_POST['login'])){
    //verify that the login worked
    $email_post = $_POST['email'];//probably sanitize inputs
    $pass_post = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users");//Select * allows me to pick different rows of the table in the while loop
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $email = $row['email'];
      $pass = $row['password_'];
      if($email_post == $email && $pass_post == $pass){
        //successful login
        echo 'Login successful!';
      }
      else{
        echo 'incorrect username or password';
      }
    }
    //then go to the other page
    sleep(5);
    header("Location: ./index.php");
    exit();
  }

  if(isset($_POST['signup'])){
    //add email to database
    $email = $_POST['email'];//sanitize inputs probably
    $pass = $_POST['password'];
    $psql = "INSERT INTO users (email, password_) VALUES ('$email', '$pass')";
    $stmt= $db->prepare($psql);
    $stmt->execute();
    //TODO Maybe add address and address id to user id
  }
  //header("Location: ./signup.php");
  //exit();
?>