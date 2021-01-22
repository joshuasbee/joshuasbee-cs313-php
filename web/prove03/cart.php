<?php
if (!isset($_SESSION)) { session_start(); }
// echo "This is the cart<br>";
// var_dump($_SESSION);
echo '<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">
  <title>Checkout</title>
</head>

<body>';

echo 'Your Cart Contains:<br><br>';
if(isset($_SESSION['Anduril'])){
  echo $_SESSION["Anduril"];
  echo "<form action='' method='post' id='AndurilForm'>
  <input type='hidden' value='Anduril' name='Anduril'>
  <button class='btn' type='submit' form='AndurilForm' value='Anduril'>Remove from cart</button>
  </form>";
  if(isset($_POST['Anduril'])){
    unset($_SESSION['Anduril']);
    echo "<meta http-equiv='refresh' content='0'>";//from https://stackoverflow.com/questions/10643626/refresh-page-after-form-submitting
  }
}
if(isset($_SESSION['Glamdring'])){
  echo $_SESSION["Glamdring"];
  echo "<form action='' method='post' id='GlamdringForm'>
  <input type='hidden' value='Glamdring' name='Glamdring'>
  <button class='btn' type='submit' form='GlamdringForm' value='Glamdring'>Remove from cart</button>
  </form>";
  if(isset($_POST['Glamdring'])){
    unset($_SESSION['Glamdring']);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
if(isset($_SESSION['Sting'])){
  echo $_SESSION['Sting'];
  echo "<form action='' method='post' id='StingForm'>
  <input type='hidden' value='Sting' name='Sting'>
  <button class='btn' type='submit' form='StingForm' value='Sting'>Remove from cart</button>
  </form>";
  if(isset($_POST['Sting'])){
    unset($_SESSION['Sting']);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
if(isset($_SESSION['OrcArmor'])){
  echo $_SESSION['OrcArmor'];
  echo "<form action='' method='post' id='OrcForm'>
  <input type='hidden' value='Orc Armor' name='OrcArmor'>
  <button class='btn' type='submit' form='OrcForm' value='OrcArmor'>Remove from cart</button>
  </form>";
  if(isset($_POST['OrcArmor'])){
    unset($_SESSION['OrcArmor']);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
if(isset($_SESSION['LegoGandalf'])){
  echo $_SESSION['LegoGandalf'];
  echo "<form action='' method='post' id='GandalfForm'>
  <input type='hidden' value='Lego Gandalf' name='LegoGandalf'>
  <button class='btn' type='submit' form='GandalfForm'>Remove from cart</button>
  </form>";
  if(isset($_POST['LegoGandalf'])){
    unset($_SESSION['LegoGandalf']);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
echo '<br>' . '<a href="index.php"><- Back to store</a>';
echo '<br><br>' . '<a href="checkout.php">Checkout -></a>';

echo '</body></html>';
?>