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
      echo 'carts: ' . $carts[$count];
      $count++;
    }
//Get the items from all the cart ID's and print them
    $items;
    for ($i=0; $i < $count; $i++) { 
    $stmt = $GLOBALS['db']->query("SELECT item_id FROM cart_item WHERE cart_id = '$carts[$i]'")->fetch();
    $items[$i] = $stmt['item_id'];
    }


    $stmt = $GLOBALS['db']->prepare("SELECT * FROM items WHERE item_id = '$iid'");//Select * allows me to pick different rows of the table in the while loop
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      // $names = $row['item_name'];
      // $names = ucwords($names);
      // echo 'item names: '. $names . '<br>';
      // echo '<div class="row justify-content-center">';
            //all this does now is print every item and their name
      // echo '</div>';
    }
      
    //select item_id from cart_item where cart_id = (cart_id from above);
    //display items
  }
  else{
    echo 'not logged in';
    //maybe say sign up to access your cart
  }
  echo '<div class="row justify-content-center">';
  echo '<a href="index.php"><- Return to store</a></div>';
  ?>
</body>

</html>