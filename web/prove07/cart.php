<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>Cart</title>
</head>
<body>
  
  <?php
   require "../db/dbConnect.php";
   $GLOBALS['db'] = get_db();
  if (!isset($_SESSION)) { session_start(); }
  if(isset($_SESSION['user_id'])){
    $uid = $_SESSION['user_id'];
    //display all item names and remove from cart buttons
  $stmt = $db->prepare("SELECT items.item_name, items.item_id FROM user_to_cart INNER JOIN cart_item ON user_to_cart.cart_id = cart_item.cart_id 
    INNER JOIN items ON cart_item.item_id = items.item_id;");
  $stmt->execute();
  echo '<form method=post>';
  $count = 0;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $name = $row['item_name'];
    $id = $row['item_id'];
    echo '<div class="row justify-content-center">';
    $name_ = str_replace("_", " ", $name);
    $nameUC = ucwords($name_);
    echo $nameUC;
    
    echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>remove from cart</button>";
    
    echo '</div>';
    $count++;
  }
  echo "<input value='$name' type='hidden'>";
  echo '</form>';
  if ($count == 0){//make a counter in the loop, if it is zero, run this
    echo '<div class="row justify-content-center">Cart is empty!</div>';
  }
  }//ending if logged in
  else{ echo 'not logged in'; }
  var_dump($_POST);
  $rem = '';
  if(isset($_POST['glamdring'])){
    $rem = 'glamdring';
  }
  if(isset($_POST['sting'])){
    $rem = 'sting';
  }


  if(isset($rem) && isset($_SESSION['user_id'])){//TODO change postname because that is whatever the last item was in the loop
  //remove item from cart
  $n = $rem;
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
  //delete using cid and iid


  //alert 'item removed successfully'
    
  }
  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  ?>
</body>
</html>