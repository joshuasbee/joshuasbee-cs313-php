<?php
  if(isset($_GET['login'])){
    //verify that the login worked

    //then go to the other page
    //header("Location: http://www.example.com/another-page.php");
    //exit();
  }

  if(isset($_GET['signup'])){
    //add email to database
    header("Location: ./signup.php");
    exit();
  }


?>