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
<body>
<div class='container'> 
  <h1 class='text-center'>Log in</h1>
  <span class="float-left"><a href="index.php"><- Return to store</a></span>
  <div class='row justify-content-center align-items-center'>
    <form action="logsign.php" method="post" class='form'>
      <input type='text' placeholder='email' name='email' class='form-control'>
      <br>
      <input type='password' placeholder='password' name='password' class='form-control'>
      <br>
      <button type='submit' class='btn btn-info' name='login'>Login</button>
      <button type='submit' class='btn btn-info float-right' name='signup'>Sign up</button>
    </form>
  </div>
</div>
</body>
</html>