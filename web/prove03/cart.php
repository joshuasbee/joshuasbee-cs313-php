<?php
​
session_start(); // start the session 
​
?>
​
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
​
<!--This is the form for my items-->
<h1>My Form</h1>
<form action="" method="POST">
<p>Item1<input type="text" name="item1"></p>
<p>Item2<input type="text" name="item2"></p>
<button type="submit" name="submit" value="true">Submit</button>
</form>
​
<!--This will destory all items in session-->
<h1>Destroy Session</h1>
<form action="" method="get">
<button type="submit" name="destroy" value="true">Destroy Session</button>
</form>
​
</body>
</html>
​
<?php
​
//empty session
if (isset($_GET["destroy"])){
    session_destroy();
}
​
​
?>
​
<!--Check to see if one of the items was sent via post-->
<?php 
if(isset($_POST['item1']))
{
    $_SESSION["item1"] = $_POST['item1'];
}
​
if(isset($_POST['item2']))
{
    $_SESSION["item2"] = $_POST['item2'];
}
​
//echo variable info
echo "Session";
var_dump($_SESSION);
​
?>