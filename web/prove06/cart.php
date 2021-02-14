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

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      // $pic = $row['image_dir'];
      // $names = $row['item_name'];
      // $names = ucwords($names);
      echo 'cart_id '. $row['cart_id'] . '<br>';


      
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