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
  if (!isset($_SESSION)) { session_start(); }
  require "../db/dbConnect.php";
  // $db='db';
  $GLOBALS['db'] = get_db();

  if(isset($_POST['login'])){//check if login button was clicked
    //verify that the login worked
    $email_post = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass_post = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $stmt = $GLOBALS['db']->prepare("SELECT * FROM users");//Select * allows me to pick multiple rows of the table in the while loop
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $email = $row['email'];
      $pass = $row['password_'];
      if($email_post == $email && $pass_post == $pass){//check for match of input and database
        //if successful login, then go to the other page
        $user_id = "SELECT user_id FROM users WHERE email = '$email'";
        $stmt = $GLOBALS['db']->query($user_id)->fetch();
        $_SESSION['user_id'] = $stmt['user_id'];//Set session variable to user's user id
        header("Location: ./index.php");
        exit();
      }
      else{
        echo 'Incorrect username or password!';
        exit();
      }
    }
  }
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
      <input type='text' placeholder='Country' name='country' value='<?php echo (isset($_POST['country']))?$_POST['country']:'';?>' class='form-control'>
      <br>
      <input type='number' placeholder='Zip Code' name='zipcode' value='<?php echo (isset($_POST['zipcode']))?$_POST['zipcode']:'';?>' class='form-control'>
      <br>
      <input type="radio" id="Billing" name="billship" value='bill'><!-- Radio button selection is not preserved -->
      <label for="Billing">Billing Address</label>
      <input type="radio" id="Shipping" name="billship" value='ship'>
      <label for="Shipping">Shipping Address</label>
      <input type="radio" id="Both" name="billship" value='both'>
      <label for="Both">Both</label>
      <button type='submit' class='btn btn-info' name='sign-up'>Sign up</button><br>
    </form>
  </div>
  <?php
  function upload($email, $password, $street, $city, $state, $country, $zipcode, $billship, $arr)
  {
    //insert into users table the email and password from the form
    $psql = "INSERT INTO users (email, password_) VALUES ('$email', '$password')";
    $stmt = $GLOBALS[$db]->prepare($psql)->execute();
    //update address table with address from form
    $address = "INSERT INTO address_ (street, city, state_, country, zip, billing, shipping) VALUES ('$street', '$city', '$state', '$country', $zipcode, $arr[$billship])";
    $stmt = $GLOBALS[$db]->prepare($address)->execute();
    //get the user id and save to a php variable, uid, for inserting to user_to_address table
    $user_id = "SELECT user_id FROM users WHERE email = '$email'";
    $stmt = $GLOBALS[$db]->query($user_id)->fetch();
    $uid = $stmt['user_id'];
    //get the address id and save to a php variable, aid, for inserting to user_to_address table
    $address_id = "SELECT address_id FROM address_ WHERE street = '$street' AND city='$city'";
    $add = $GLOBALS[$db]->query($address_id)->fetch();
    $aid = $add['address_id'];    
    //add to user_to_address table the new user id and their address ID for use when 'shipping'
    $add_to_id = "INSERT INTO user_to_address (user_id, address_id) VALUES ('$uid', '$aid')";
    $stmt = $GLOBALS[$db]->prepare($add_to_id)->execute();

    $_SESSION['user_id'] = $uid;//Set session variable to user's user id, that way they behave differently when adding to cart
  }

  function validate(){
    $p_ex = "/[-()*\&\^%$#@\!0-9a-zA-z]{6,16}/";
    $z_ex = "/\d{5}/";
    $err = 0;//error flag to check if we submit information to database
    if("" != trim($_POST['email']) && "" != trim($_POST["password"]) && "" != trim($_POST["street"]) &&
     "" != trim($_POST["city"]) && "" != trim($_POST['state']) && "" != trim($_POST["zipcode"]) && "" != trim($_POST["billship"])){
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
      $street = filter_var($_POST["street"], FILTER_SANITIZE_STRING);
      $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
      $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
      $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
      $zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_NUMBER_INT);
      $billship = filter_var($_POST["billship"], FILTER_SANITIZE_STRING); 
      $arr = [//then in sql insert we should be able to use $arr[$billship] to get the appropriate t and f.
        'bill' => "'t', 'f'",
        'ship' => "'f', 't'",
        'both' => "'t', 't'"
      ];
    }//if none of the input fields are empty, then sanitize and set variables.
    else { echo '<div class="text-danger text-center">All fields must be filled</div>'; $err=1; }
    if ($err != 1){
      // Validate e-mail
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){}
      else { echo '<div class="text-danger text-center">Invalid email</div>'; $err = 1;}
      if(preg_match($p_ex, $password)){} 
      else{echo '<div class="text-danger text-center">Invalid password, must be 6-16 characters, can only contain letters, numbers, and !@#$%^&*()-</div>'; $err = 1;}
      if(preg_match($z_ex, $zipcode) && strlen($zipcode) < 6){} 
      else{echo '<div class="text-danger text-center">Zip code must be 5 digits</div>'; $err = 1;}
    }
    if ($err != 1){
      upload($email, $password, $street, $city, $state, $country, $zipcode, $billship, $arr);
    }

  }
  if(isset($_POST['sign-up'])){//calls validate when sign up button is pressed
    unset($_POST['sign-up']);//makes sure you can click the button again if you didn't do the form correctly
    validate();
  }
  ?>
</div><!-- container div -->
</body>
</html>