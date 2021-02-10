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
  <title>Login</title>
</head>
<?php
  require "../db/dbConnect.php";
  $db = get_db();
  if(isset($_POST['login'])){
    //verify that the login worked
    $email_post = $_POST['email'];//probably sanitize inputs
    $pass_post = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users");//Select * allows me to pick different rows of the table in the while loop
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $email = $row['email'];
      $pass = $row['password_'];
      if($email_post == $email && $pass_post == $pass){
        //if successful login, then go to the other page
        echo 'Login successful!';
        header("Location: ./index.php");
        exit();
      }
      else{
        echo 'Incorrect username or password!';
        exit();
      }
    }
  }

  if(isset($_POST['signup'])){
    //add email to database
    $email = $_POST['email'];//sanitize inputs probably
    $pass = $_POST['password'];
    // $psql = "INSERT INTO users (email, password_) VALUES ('$email', '$pass')";
    // $stmt= $db->prepare($psql);
    // $stmt->execute();
    //TODO Maybe add address and address id to user id
  }
  //header("Location: ./signup.php");
  //exit();
?>
<body>
<div class='container'> 
  <h1 class='text-center'>Sign Up</h1>
  <div class='row justify-content-center align-items-center'>
    <form action="logsign.php" method="post" class='form'><!-- ACTION something maybe? -->
      <input type='text' placeholder='email' name='email' value='<?php echo (isset($email))?$email:"";?>' class='form-control'>
      <br>
      <input type='password' placeholder='password' name='password' value='<?php echo (isset($pass))?$pass:'';?>' class='form-control'>
      <br>
      <input type='text' placeholder='Street address' name='street' class='form-control'>
      <br>
      <input type='text' placeholder='City' name='city' class='form-control'>
      <br>
      <input type='text' placeholder='State' name='state' class='form-control'>
      <br>
      <input type='text' placeholder='Zip Code' name='zipcode' class='form-control'>
      <br>
      <input type="radio" id="Billing" name="billship" value="bill">
      <label for="Billing">Billing Address</label>
      <input type="radio" id="Shipping" name="billship" value="ship">
      <label for="Shipping">Shipping Address</label>
      <input type="radio" id="Both" name="billship" value="both">
      <label for="Both">Both</label>
      <button type='submit' class='btn btn-info' name='sign-up'>Sign up</button>
    </form>
  </div>
</div>
</body>
</html>
<?php 
function validate(){
  echo 'validate function';
}
if(isset($_POST['sign-up'])){
  validate();
}



?>