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
    echo 'name variable has: ' . $name;
    if (count($row['item_name']) > 0) {
    echo '<div class="row justify-content-center">';
    $name_ = str_replace("_", " ", $name);
    $nameUC = ucwords($name_);
    echo $nameUC;
    echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>remove from cart</button>";
    echo '</div>';
    }
    else{echo 'cart is empty';}
  }
  }//ending if logged in
  else{ echo 'not logged in'; }
  if(isset($_POST[$name]) && isset($_SESSION['user_id'])){
  //remove item from cart
  }
  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  ?>
</body>
</html>