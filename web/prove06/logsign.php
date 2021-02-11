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
<script>
// function ajax(str) {
//   if (str.length == 0) {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   } else {
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         document.getElementById("txtHint").innerHTML = this.responseText;
//       }
//     };
//     xmlhttp.open("GET", "gethint.php?q=" + str, true);
//     xmlhttp.send();
//   }
// }
</script>
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
    
    //TODO Maybe add address and address id to user id
  }
  //header("Location: ./signup.php");
  //exit();
?>
<body>
<div class='container'> 
  <h1 class='text-center'>Sign Up</h1>
  <div class='row justify-content-center align-items-center'>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class='form'>
      <input type='text' placeholder='email' name='email' value='<?php echo (isset($_POST['email']))?$_POST['email']:"";?>' class='form-control'>
      <br>
      <input type='password' placeholder='password' name='password' value='<?php echo (isset($_POST['password']))?$_POST['password']:'';?>' class='form-control'>
      <br>
      <input type='text' placeholder='Street address' name='street' value='<?php echo (isset($_POST['street']))?$_POST['street']:'';?>' class='form-control'>
      <br>
      <input type='text' placeholder='City' name='city' value='<?php echo (isset($_POST['city']))?$_POST['city']:'';?>' class='form-control'>
      <br>
      <input type='text' placeholder='State' name='state' value='<?php echo (isset($_POST['state']))?$_POST['state']:'';?>' class='form-control'>
      <br>
      <input type='number' placeholder='Zip Code' name='zipcode' value='<?php echo (isset($_POST['zipcode']))?$_POST['zipcode']:'';?>' class='form-control'>
      <br>
      <input type="radio" id="Billing" name="billship" value='bill'>
      <label for="Billing">Billing Address</label>
      <input type="radio" id="Shipping" name="billship" value='ship'>
      <label for="Shipping">Shipping Address</label>
      <input type="radio" id="Both" name="billship" value='both'>
      <label for="Both">Both</label>
      <button type='submit' class='btn btn-info' name='sign-up'>Sign up</button><br>
    </form>
  </div>
  <?php 
  function upload(){
    $psql = "INSERT INTO users (email, password_) VALUES ('$email', '$pass')";
    $stmt= $db->prepare($psql);
    $stmt->execute();
  }

  function validate(){
    $p_ex = "/[-()*\&\^%$#@\!0-9a-zA-z]+/";
    $z_ex = "/\d{5}/";
    if("" != trim($_POST['email']) && ""!= trim($_POST["password"]) && "" != trim($_POST["street"]) &&
     "" != trim($_POST["city"]) && "" != trim($_POST['state']) && "" != trim($_POST["zipcode"]) && "" != trim($_POST["billship"])){
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
      $street = filter_var($_POST["street"], FILTER_SANITIZE_STRING);
      $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
      $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
      $zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_NUMBER_INT);
      $billship = filter_var($_POST["billship"], FILTER_SANITIZE_STRING);
      // Validate e-mail
      echo (filter_var($email, FILTER_VALIDATE_EMAIL))?"":'<div class="text-danger text-center">Invalid email</div>';
      echo (preg_match($p_ex, $password))?"":'<div class="text-danger text-center">Invalid password, can only contain letters, numbers, and !@#$%^&*()-</div>';
      echo (preg_match($z_ex, $zipcode))?"":'<div class="text-danger text-center">Zip code must be 5 digits</div>';
    } 
    else{
      echo '<div class="text-danger text-center">All fields must be filled</div>';
    }

    // $str = "Visit W3Schools";
    // $pattern = "/w3schools/i";
    // echo preg_match($pattern, $str); 
    // upload();
    }
    if(isset($_POST['sign-up'])){//calls validate when sign up button is pressed
      unset($_POST['sign-up']);//makes sure you can click the button again if you didn't do the form correctly
      validate();
  }
  ?>
</div><!-- container div -->
</body>
</html>