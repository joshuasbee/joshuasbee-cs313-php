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

  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>LOTR store</title>
</head>

<body>
  <span class="float-right">
    <form action="" method='GET'><!-- change action to call cart.php eventually -->
      <input type="submit" value="Cart" class='btn-success' />
    </form>
  </span>
<!--  -->
  <div class="input-group rounded">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
    aria-describedby="search-addon" />
  <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
  </span>
</div>
<!--  -->
  <h1 class="text-center">LOTR item shop</h1>
  <div class="container">
<?php
  // $item = "anduril";//array("anduril", "glamdring", "lego_gandalf", "orc_armor", "sting");
  $stmt = $db->prepare("SELECT * FROM items");// WHERE item_name= :item"); //Getting rid of the other part allows it to loop through all images
  $stmt->execute();
  $iter_count = 0;
  // Go through each result
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if($iter_count == 0){ echo "<div class='row'>"; }
    if($iter_count == 3){ echo "</div><div class='row'>"; }//closes first row and opens next
    if($iter_count <= 4) { echo "<div class='col'>"; }
    $pic = $row['image_dir'];
    $names = $row['item_name'];
    echo "<img src='$pic'><p>$names</p>";
    
    if($iter_count <= 4){ echo "</div>"; }//closes each col
    if($iter_count == 4){ echo "</div>"; }//closes first row
    $iter_count++;
    //echo "$iter_count";
  }

?>

</div><!-- container closing tag -->
</body>
</html>


