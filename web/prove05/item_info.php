<?php 
  require "../db/dbConnect.php";
  $db = get_db();
  if (!isset($_SESSION)) { session_start(); }

  $query = $_GET['item'];
  echo "result of the get: " . "$query";
  // echo "Results for search of \"$query\":<br>";//show before capitalized
  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $query = ucwords($query);//Capitalizes each word, that is how it is in database
  // echo "searched for: " . "$query"; // This works fine
  $stmt = $db->prepare("SELECT * FROM items WHERE item_name = '$query'");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    echo "<img src='$pic'>" . "<div>$name</div>" . "Price: \$$price<br>";
    if ($stock >= 10){ echo "In stock"; }
    elseif ($stock > 1 && $stock < 10){ echo "Low stock"; }
    else { echo "Out of stock"; }
  }
?>