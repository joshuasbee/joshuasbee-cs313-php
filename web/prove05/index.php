<?php 

require "../db/dbConnect.php";
$db = get_db();

if (!isset($_SESSION)) { session_start(); }
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">
  <title>LOTR store</title>
</head>

<body>
  <span class="float-right">
    <form action="cart.php" method='GET'>
      <!-- calls the cart.php file -->
      <input type="submit" value="Cart" class='btn-success' />
    </form>
  </span>
  <h1 class="text-center">LOTR item shop</h1>
<?php
  $item = "anduril";//array("anduril", "glamdring", "lego_gandalf", "orc_armor", "sting");
  $statement = $db->prepare("SELECT image_dir FROM items");// WHERE item_name= :item");
  // $stmt = $db->prepare('SELECT * FROM scout WHERE first_nsme = :name');
  //$name= '$name';
  // $statement->bindValue(':item', $item, PDO::PARAM_STR);
  $statement->execute();
  // Go through each result
  while ($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    // The variable "row" now holds the complete record for that
    // row, and we can access the different values based on their
    // name
    $pic = $row['image_dir'];
    echo "<img src='$pic'>";
  }
?>


</body>
</html>

