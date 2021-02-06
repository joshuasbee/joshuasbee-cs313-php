<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php 
  require "../db/dbConnect.php";
  $db = get_db();
  if (!isset($_SESSION)) { session_start(); }
  //lots of if(isset($_GET['Anduril'])) {$query = $_GET['Anduril'];}
  if(isset($_GET['anduril'])){$query = $_GET['anduril'];}
  elseif(isset($_GET['glamdring'])){$query = $_GET['glamdring'];}
  elseif(isset($_GET['sting'])){$query = $_GET['sting'];}
  elseif(isset($_GET['lego_gandalf'])){$query = $_GET['lego_gandalf'];}//something changes spaces to _ 
  elseif(isset($_GET['orc_armor'])){$query = $_GET['orc_armor'];}
  // else{echo var_dump($_GET);}

  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $stmt = $db->prepare("SELECT * FROM items WHERE item_name = '$query'");
  $stmt->execute(); ?>

  <div class="container justify-content-center">
  <?php
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    $nameUC = ucwords($name);//capitalize the name of the item for display
    echo "<div class='row w-50 mx-auto'>";//CHECK THIS ONE
    echo "<img src='$pic'></div>" . "<div class='row'>$nameUC</div>";
    echo "<div class='row'>Price: \$$price</div><div class='row'>";
    if ($stock >= 10){ echo "In stock"; }
    elseif ($stock > 0 && $stock < 10){ echo "Low stock"; }
    else { echo "Out of stock"; }
    echo "</div>";//closes row for stock
    if ($stock > 0){
      echo "<div class='row'>";
      echo "<button id='$name' value='$name' name='$name'>Add to cart</button>";
      echo "</div>";
    }
    
  }
?>
</div>

</body>
</html>