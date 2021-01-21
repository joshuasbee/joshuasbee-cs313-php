<?php 
session_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>LOTR store</title>
  </head>
  <body>
    <span class="float-right">
      <form action="cart.php" method='GET'>
       <!-- <button class='btn btn-success'>Cart</button>  -->
       <input type="submit" value="Cart" class='btn-success'/>
      </form>
    </span>
    
    <h1 class="text-center">LOTR item shop</h1>
    <div class="container">     
      <div class="row">
        <div class="col">
          <img src="imgs/Anduril.jpeg" class="img-responsive">
          <p>Anduril</p>
          <button onclick="add_to_cart('Anduril')">Add to cart</button>
        </div>
        <div class="col">
          <img src="imgs/Glamdring.png" class="img-responsive">
          <p>Glamdring</p>
          <button onclick="add_to_cart('Glamdring')">Add to cart</button>
        </div>
        <div class="col">
          <img src="imgs/Sting.png" class="img-responsive" id="sting">
          <p>Sting</p>
          <button onclick="add_to_cart('Sting')">Add to cart</button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <img src="imgs/orc-armor.png" class="img-responsive">
          <p>Orc armor set</p>
          <button onclick="add_to_cart('Orc Armor')">Add to cart</button>
        </div>
        <div class="col">
          <img src="imgs/lego-gandalf.png" class="img-responsive">
          <p>Lego Gandalf</p>
          <button onclick="add_to_cart('Lego Gandalf')">Add to cart</button>
        </div>
      </div>
    </div>
    <script src='script.js'></script>
  </body>
</html>
​
<?php //empty session
if (isset($_GET["destroy"])){
  session_destroy();
}
?>

<!-- Check if one of the items was sent by post -->
<?php

if(isset($_POST['item1'])){
  $_SESSION["item1"] = $_POST['item1'];
}

if(isset($_POST['item2'])){
  $_SESSION["item2"] = $_POST['item2'];
}

// echo variable info
echo "Session";
var_dump($_SESSION);
?>