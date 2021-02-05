<?php 
require "../db/dbConnect.php";
$db = get_db();
if (!isset($_SESSION)) { session_start(); }

$query = $_GET['query'];
$query = htmlspecialchars($query);//filter out <script> or other malicious code
$query = ucwords($query);//Capitalizes each word, that is how it is in database
// echo "searched for: " . "$query"; // This works fine
$stmt = $db->prepare("SELECT * FROM items WHERE item_name LIKE '%$query%'");
$stmt->execute();
echo "Results: <br>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  $name = $row['item_name'];
  $pic = $row['image_dir'];
  echo "$pic" . "$name";
}
?>