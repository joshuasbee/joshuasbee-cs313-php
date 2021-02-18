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
  <title>Cart</title>
</head>
<body>
  <form method=post>
  <?php
   require "../db/dbConnect.php";
   $GLOBALS['db'] = get_db();
  if (!isset($_SESSION)) { session_start(); }
  if(isset($_SESSION['user_id'])){
    $uid = $_SESSION['user_id'];
    //display all item names and remove from cart buttons
  $stmt = $db->prepare("SELECT items.item_name FROM user_to_cart INNER JOIN cart_item ON user_to_cart.cart_id = cart_item.cart_id 
    INNER JOIN items ON cart_item.item_id = items.item_id;");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    echo '<div class="row justify-content-center">';
    $name_ = str_replace("_", " ", $name);
    $nameUC = ucwords($name_);
    echo $nameUC;
    echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>remove from cart</button>";
    echo '</div>';
  }
  if (is_array($row)){//make a counter in the loop, if it is zero, run this
    echo '<div class="row justify-content-center">Cart is empty!</div>';
  }
  }//ending if logged in
  else{ echo 'not logged in'; }
  if(isset($_POST[$name]) && isset($_SESSION['user_id'])){
  //remove item from cart
      // $psql = "INSERT INTO cart_item (item_id) VALUES ('$iid')";
      // $stmt = $GLOBALS['db']->prepare($psql)->execute();
  //then get the cart id of most recent cart addition, which is line above
      // $cart_id = "SELECT cart_id FROM cart_item WHERE cart_id = (SELECT MAX(cart_id) from cart_item)";
      // $stmt = $GLOBALS['db']->query($cart_id)->fetch();
      // $cid = $stmt['cart_id'];
      $n = $_POST[$name];
      $x = "SELECT cart_item.cart_id, cart_item.item_id 
              FROM cart_item
              INNER JOIN user_to_cart ON cart_item.cart_id = user_to_cart.cart_id
              WHERE item_id = (
                SELECT item_id
                  FROM items
                  WHERE item_name = '$n');";
      $stmt = $GLOBALS['db']->query($x)->fetch();
      $cid = $stmt['cart_id'];
      $iid = $stmt['item_id'];
      echo 'cartID: ' . $cid . '<br>ItemID: ' . $iid;
  //add it to user_to_cart_id
      // $uid = $_SESSION['user_id'];
      // $psql = "INSERT INTO user_to_cart (cart_id, user_id) VALUES ('$cid', '$uid')";
      // $stmt = $GLOBALS['db']->prepare($psql)->execute();
    

  }
  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  ?>
</body>
</html>