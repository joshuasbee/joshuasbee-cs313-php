<?php
if (!isset($_SESSION)) { session_start(); }

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
  <title>Purchase received!</title>
</head>
<body>
  <a href="index.php"><- Back to store</a>
</body>
</html>';

  echo 'Items purchased:<br>';
  if(isset($_SESSION['Anduril'])){
    echo $_SESSION["Anduril"] . '<br>';
    unset($_SESSION['Anduril']);
  }
  if(isset($_SESSION['Glamdring'])){
    echo $_SESSION["Glamdring"] . '<br>';
    unset($_SESSION["Glamdring"]);
  }
  if(isset($_SESSION['Sting'])){
    echo $_SESSION['Sting'] . '<br>';
    unset($_SESSION['Sting']);
  }
  if(isset($_SESSION['OrcArmor'])){
    echo $_SESSION['OrcArmor'] . '<br>';
    unset($_SESSION['OrcArmor']);
  }
  if(isset($_SESSION['LegoGandalf'])){
    echo $_SESSION['LegoGandalf'] . '<br>';
    unset($_SESSION['LegoGandalf']);
  }

  echo '<p>Items will be shipped to:</p>';
  echo htmlspecialchars($_GET['address']) . ' ' .
    htmlspecialchars($_GET['city']) . ', ' .
    htmlspecialchars($_GET['state']) . ', ' .
    htmlspecialchars($_GET['zip']) . '<br>';
?>

