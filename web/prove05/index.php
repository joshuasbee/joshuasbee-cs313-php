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

  <link rel="stylesheet" href="style.css">
  <title>LOTR store</title>
</head>

<body>
  <span class="float-right">
    <form action="cart.php" method='GET'>
      <!-- calls the cart.php file -->
      <input type="submit" value="Cart" class='btn-success' />
    </form>
  </span>
  <h1 class="text-center">LOTR item shop</h1>
  <div class="container">
    <div class="row">
      <div class="col">
      <?php 
      //$anduril_path = 'SELECT image_dir FROM items WHERE item_name=\'Anduril\';';
      ?>
        <img src=<?php //pg_query($connect, $anduril_path)?> class="img-responsive">
        <p>Anduril</p>
        <form action='' method='post' id='AndurilForm'>
          <input type='hidden' value='Anduril' name='Anduril'>
          <button class='btn' type='submit' form='AndurilForm'>Add to cart</button>
        </form>
      </div>
      <div class="col">
        <!-- <img src="../imgs/Glamdring.png" class="img-responsive"> -->
        <p>Glamdring</p>
        <form action='' method='post' id='GlamdringForm'>
          <input type='hidden' value='Glamdring' name='Glamdring'>
          <button class='btn' type='submit' form='GlamdringForm'>Add to cart</button>
        </form>
      </div>
      <div class="col">
        <!-- <img src="imgs/Sting.png" class="img-responsive" id="sting"> -->
        <p>Sting</p>
        <form action='' method='post' id='StingForm'>
          <input type='hidden' value='Sting' name='Sting'>
          <button class='btn' type='submit' form='StingForm'>Add to cart</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <!-- <img src="imgs/orc-armor.png" class="img-responsive"> -->
        <p>Orc armor set</p>
        <form action='' method='post' id='OrcForm'>
          <input type='hidden' value='Orc Armor' name='OrcArmor'>
          <button class='btn' type='submit' form='OrcForm'>Add to cart</button>
        </form>
      </div>
      <div class="col">
        <!-- <img src="imgs/lego-gandalf.png" class="img-responsive"> -->
        <p>Lego Gandalf</p>
        <form action='' method='post' id='GandalfForm'>
          <input type='hidden' value='Lego Gandalf' name='LegoGandalf'>
          <button class='btn' type='submit' form='GandalfForm'>Add to cart</button>
        </form>
      </div>
    </div>
  </div>
  <!-- <form action="" method="get">
    <!- - This is for testing only - ->
    <button type="submit" name="destroy" value="true">Destroy Session</button>
  </form> -->
  

</body>
</html>


<?php
  $item = "anduril";//array("anduril", "glamdring", "lego_gandalf", "orc_armor", "sting");
  $statement = $db->prepare("SELECT image_dir FROM items WHERE item_name= :item");
  // $stmt = $db->prepare('SELECT * FROM scout WHERE first_nsme = :name');
  //$name= '$name';
  $statement->bindValue(':item', $item, PDO::PARAM_STR);
  $statement->execute();
  // Go through each result
  while ($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    // The variable "row" now holds the complete record for that
    // row, and we can access the different values based on their
    // name
    $pic = $row['image_dir'];
    echo "<img src='$pic'>";
  }
?>
