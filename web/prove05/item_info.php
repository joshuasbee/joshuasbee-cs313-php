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
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    $nameUC = ucwords($name);//capitalize the name of the item for display
    echo "<img src='$pic'>" . "<div>$nameUC</div>" . "Price: \$$price<br>";
    if ($stock >= 10){ echo "In stock<br>"; }
    elseif ($stock > 1 && $stock < 10){ echo "Low stock<br>"; }
    else { echo "Out of stock"; }
    if ($stock > 0){
      echo "<button id='$name' value='$name' name='$name'>Add to cart</button>";
    }
  }
?>