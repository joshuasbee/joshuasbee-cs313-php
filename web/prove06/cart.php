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
  cart
  <?php
  if (!isset($_SESSION)) { session_start(); }
  if(isset($_SESSION['user_id'])){
    echo 'logged in';
    //get their items in their cart and display them
    //SELECT cart_id FROM user_to_cart WHERE user_id = $_SESSION['user_id']; could be multiple carts
    //select item_id from cart_item where cart_id = (cart_id from above);
    //display items
  }
  else{
    echo 'not logged in';
    //maybe say sign up to access your cart
  }
  ?>
</body>

</html>