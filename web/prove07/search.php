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
<span class="float-left"><a href="index.php"><- Return to store</a></span>
<span class="float-right">
    <form action="cart.php" method='get'>
      <input type="submit" value="Cart" class='btn-success rounded'>
    </form>
</span>
<form method=post>
<div class='container'>
<?php 
  require "../db/dbConnect.php";
  $GLOBALS['db'] = get_db();
  if (!isset($_SESSION)) { session_start(); }

  $query = $_GET['query'];
  $query = htmlspecialchars($query);//filter out <script> or other malicious code
  $query = lcfirst($query);//Lowercase each word like in database

  $stmt = $db->prepare("SELECT * FROM items WHERE item_name LIKE '%$query%'");
  $stmt->execute();
  $count = 0;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $pic = $row['image_dir'];
    $stock = $row['quantity'];
    $price = $row['price'];
    $name_ = str_replace("_", " ", $name);
    $nameUC = ucwords($name_);//capitalize the name of the item for display
    echo "<div class='row justify-content-center'>";
    echo "<img src='$pic'>";
    echo "</div><div class='row justify-content-center'>";
    echo "$nameUC";
    echo "</div><div class='row justify-content-center'>";
    echo "Price: \$$price<br>";
    echo "</div>";
    echo "<div class='row justify-content-center'>";
    if ($stock >= 10){ echo "<p class='text-success'>In stock</p>"; }
    elseif ($stock > 1 && $stock < 10){ echo "<p class='text-warning'>Low stock</p>"; }
    else { echo "<p class='text-danger'>Out of stock</p>"; }
    echo "</div><div class='row justify-content-center'>";
    if ($stock > 0){
      echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>Add to cart</button>";
    }  
    echo '</div>';//closing div tag for last justify-content-center
    $count++;
  }
   
  echo "<br></div></form>";//close container div and form
  $add = '';
  if(isset($_POST['anduril'])){ $add = 'anduril'; }
  if(isset($_POST['glamdring'])){ $add = 'glamdring'; }
  if(isset($_POST['sting'])){ $add = 'sting'; }
  if(isset($_POST['lego_gandalf'])){ $add = 'lego_gandalf'; }
  if(isset($_POST['orc_armor'])){ $add = 'orc_armor'; }
    var_dump($_POST);
  if (isset($_SESSION['user_id']) && strlen($add) > 2 && $count > 0){//if the button was clicked and they are logged in, $name holds the name of the item as it is in the database
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
</body>
</html>