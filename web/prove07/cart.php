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
    //get their items in their cart and display them
    //SELECT cart_id FROM user_to_cart WHERE user_id = $_SESSION['user_id']; could be multiple carts
    $stmt = $GLOBALS['db']->prepare("SELECT * FROM user_to_cart WHERE user_id = '$uid'");//Select * allows me to pick different rows of the table in the while loop
    $stmt->execute();
    //get all cart ids in an array
    $count = 0;
    $carts;//initialize variable for bigger scope
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $carts[$count] = $row['cart_id'];
      $count++;
    }
    //$carts is array of cart ID's for that user's ID
    if (isset($carts)){
      //Get the items from all the cart ID's
      $items;
      for ($i=0; $i < $count; $i++) { 
      $stmt = $GLOBALS['db']->query("SELECT item_id FROM cart_item WHERE cart_id = '$carts[$i]'")->fetch();
      $items[$i] = $stmt['item_id'];
      }
      //$items is an array of item ID's with the given cart ID
     
      //display all item names and remove from cart buttons
      for ($j=0; $j < $i; $j++) { 
        $stmt = $GLOBALS['db']->query("SELECT * FROM items WHERE item_id = '$items[$j]'")->fetch();
        echo '<div class="row justify-content-center">';
        $name = $stmt['item_name'];
        $name_ = str_replace("_", " ", $name);
        $nameUC = ucwords($name_);
        echo $nameUC;
        
        //TODO add remove from cart button
        // echo '<div class="row justify-content-center">';
        echo "<button id='$name' value='$name' name='$name' class='rounded btn-success'>remove from cart</button>";
        echo '</div>';
        // echo '</div';
      }
      echo '</form>';
    }
    else{ echo '<div class="row justify-content-center">Cart is empty</div>'; }
  }//ending for if userid is set
  else{
    echo 'not logged in';
    //maybe say sign up to access your cart
  }
  if(isset($_POST[$name]) && isset($_SESSION['user_id'])){
  //remove item from cart
    echo 'remove ' . $name;
  }

  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  ?>
</body>

</html>