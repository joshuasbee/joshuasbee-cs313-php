<?php 
  if (!isset($_SESSION)) { session_start(); }
?>
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
  <title>Checkout</title>
</head>

<body>
  <div class="container">
    <h3 class='text-center'>Address</h3>
    <form action="/confirmation.php" method='get'>
      <div class="row">
        <div class="col">
          <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
          <input type="text" id="adr" name="address" placeholder="543 W. 21st Street">
        </div>
        <div class="col">
          <label for="city"><i class="fa fa-institution"></i> City</label>
          <input type="text" id="city" name="city" placeholder="New York">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="state">State</label>
          <input type="text" id="state" name="state" placeholder="NY">
        </div>
        <div class="col">
          <label for="zip">Zip</label>
          <input type="text" id="zip" name="zip" placeholder="10001">
        </div>
      </div>
      <input type='submit' value='Checkout' class='btn'>
    </form>
    <a href="cart.php"><- Return to Cart</a>
  </div>
</body>

</html>