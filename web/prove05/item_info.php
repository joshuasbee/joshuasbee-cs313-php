<?php 
  require "../db/dbConnect.php";
  $db = get_db();
  if (!isset($_SESSION)) { session_start(); }
  //lots of if(isset($_GET['Anduril'])) {$query = $_GET['Anduril'];}
  if(isset($_GET['anduril'])){$query = $_GET['anduril'];}
  if(isset($_GET['glamdring'])){$query = $_GET['glamdring'];}
  if(isset($_GET['sting'])){$query = $_GET['sting'];}
  if(isset($_GET['lego_gandalf'])){$query = $_GET['lego_gandalf'];}
  if(isset($_GET['orc+armor'])){$query = $_GET['orc+armor'];}
  else{echo var_dump($_GET);}
  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $stmt = $db->prepare("SELECT * FROM items WHERE item_name = '$query'");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    $name = ucwords($name);
    echo "<img src='$pic'>" . "<div>$name</div>" . "Price: \$$price<br>";
    if ($stock >= 10){ echo "In stock"; }
    elseif ($stock > 1 && $stock < 10){ echo "Low stock"; }
    else { echo "Out of stock"; }
  }
?>