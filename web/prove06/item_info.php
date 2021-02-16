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
<span class="float-right">
    <form action="cart.php" method='get'>
      <input type="submit" value="Cart" class='btn-success rounded'>
    </form>
</span>
<?php 
  require "../db/dbConnect.php";
  $db = get_db();
  if (!isset($_SESSION)) { session_start(); }
  //changes what displays based on the value passed based on image clicked on index.php 
  if(isset($_GET['anduril'])){$query = $_GET['anduril'];}
  elseif(isset($_GET['glamdring'])){$query = $_GET['glamdring'];}
  elseif(isset($_GET['sting'])){$query = $_GET['sting'];}
  elseif(isset($_GET['lego_gandalf'])){$query = $_GET['lego_gandalf'];}//something changes spaces to _ 
  elseif(isset($_GET['orc_armor'])){$query = $_GET['orc_armor'];}
  
  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $stmt = $db->prepare("SELECT * FROM items WHERE item_name = '$query'");
  $stmt->execute();
  ?>
  <form method=post>
  <div class="container">
  <?php
  $name = '';
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    $namespaced = str_replace("_", " ", $name);
    echo 'after str_replace: ' . $namespaced . '<br>';
    $nameUC = ucwords($namespaced);//capitalize the name of the item for display
    echo 'after uc: ' . $nameUC . '<br>';
    echo "<div class='row justify-content-center'>";//justify-content-center must be on each item within the container div
    echo "<img src='$pic'></div>" . "<div class='row justify-content-center'>$nameUC</div>";
    echo "<div class='row justify-content-center'>Price: \$$price</div><div class='row justify-content-center'>";
    if ($stock >= 10){ echo "In stock"; }
    elseif ($stock > 0 && $stock < 10){ echo "<p class='text-warning'>Low stock</p>"; }
    else { echo "<p class='text-danger'>Out of stock</p>"; }
    echo "</div>";//closes row for stock
    if ($stock > 0){
      echo "<div class='row justify-content-center'>";
      echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>Add to cart</button>";
      echo "</div>";
    }
  }
  echo '</form>';
  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  if (isset($_POST[$name]) && isset($_SESSION['user_id'])){//if the button was clicked and they are logged in, $name holds the name of the item as it is in the database
    $item = $_POST[$name];

    $item_id = "SELECT item_id FROM items WHERE item_name = '$item'";
    $stmt = $GLOBALS['db']->query($item_id)->fetch();
    $iid = $stmt['item_id'];
    
    //add item to cart_item 
    $psql = "INSERT INTO cart_item (item_id) VALUES ('$iid')";
    $stmt = $GLOBALS['db']->prepare($psql)->execute();
    //then get the cart id of most recent cart addition, which is line above
    $cart_id = "SELECT cart_id FROM cart_item WHERE cart_id = (SELECT MAX(cart_id) from cart_item)";
    $stmt = $GLOBALS['db']->query($cart_id)->fetch();
    $cid = $stmt['cart_id'];
    //add it to user_to_cart_id
    $uid = $_SESSION['user_id'];
    $psql = "INSERT INTO user_to_cart (cart_id, user_id) VALUES ('$cid', '$uid')";
    $stmt = $GLOBALS['db']->prepare($psql)->execute();
    echo '<script>alert("Item added to cart!")</script>';
  }
  elseif(!isset($_SESSION['user_id'])){
    echo "<div class='row justify-content-center text-danger'>Login to add an item to your cart.</div>";
  }

?>
</div>

</body>
</html>