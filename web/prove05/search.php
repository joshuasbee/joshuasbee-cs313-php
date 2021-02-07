<?php 
  require "../db/dbConnect.php";
  $db = get_db();
  if (!isset($_SESSION)) { session_start(); }

  $query = $_GET['query'];
  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $query = lcfirst($query);//Lowercase each word like in database

  $stmt = $db->prepare("SELECT * FROM items WHERE item_name LIKE '%$query%'");
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
    if ($stock > 0){
      echo "<div class='row justify-content-center'>";
      echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>Add to cart</button>";
      echo "</div>";
    }
    echo "<br>";
  }
?>