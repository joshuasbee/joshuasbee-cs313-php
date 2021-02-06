<?php 

require "../db/dbConnect.php";
$db = get_db();

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

  <!-- for search icon -->
  <script src="https://use.fontawesome.com/11c7d798d9.js"></script>

  <link rel="stylesheet" href="style.css">
  <title>LOTR store</title>
</head>

<body>
  <span class="float-right">
    <form action="" method='GET'><!-- change action to call cart.php eventually -->
      <input type="submit" value="Cart" class='btn-success' />
    </form>
  </span>
<form action="search.php" method='get'>
  <div class="input-group rounded mx-auto" id="search">  <!-- mx-auto is the only thing that I found to work to center this -->
  <input class="form-control py-2 border-right-0 border" type="search" placeholder="search" name="query" id="example-search-input">
    <span class="input-group-append">
      <button class="btn btn-outline-secondary border-left-0 border" type="submit">
      <i class="fa fa-search"></i>
      </button>
    </span>
</div>
</form>
<!--  -->
  <h1 class="text-center">LOTR item shop</h1>
  
<?php
  echo "<form action='item_info.php' method='get'";
  echo "<div class='container text-center'>";//Centers everything in this div very well
  $stmt = $db->prepare("SELECT * FROM items");//Select * allows me to pick different rows of the table in the while loop
  $stmt->execute();
  $iter_count = 0;
  
  //maybe define some constants like 1st row length
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if($iter_count == 0){ echo "<div class='row'>"; }
    if($iter_count == 3){ echo "</div><div class='row'>"; }//closes first row and opens next
    if($iter_count <= 4) { echo "<div class='col'>"; }
    $pic = $row['image_dir'];
    $names = $row['item_name'];
    echo "<button id='$names' value='$names' name='$names'><img src='$pic'></button>";
    $names = ucwords($names);
    echo "<p>$names</p><br>";//name property for using $_GET['item']
    if($iter_count <= 4){ echo "</div>"; }//closes each col
    if($iter_count == 4){ echo "</div>"; }//closes first row
    $iter_count++;
  }
  echo "</form>";
?>

</div><!-- container closing tag -->
</body>
</html>