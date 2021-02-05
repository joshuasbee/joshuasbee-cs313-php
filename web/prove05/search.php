<?php 
require "../db/dbConnect.php";
$db = get_db();
if (!isset($_SESSION)) { session_start(); }

$query = $_GET['query'];
$query = htmlspecialchars($query);//filter out <script> or other malicious code
$stmt = $db->prepare("SELECT * FROM items WHERE item_name LIKE '%$query%");//Select * allows me to pick different rows of the table in the while loop
$stmt->execute();

// Go through each result
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  $names = $row['item_name'];
  echo "Results: <br>" . "$names";
}


?>