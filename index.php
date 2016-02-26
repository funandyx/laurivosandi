<?php
require_once "config.php";
include "header.php"; // This includes <html><head></head><body>
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters

if (!array_key_exists("timestamp", $_SESSION)) {
  $_SESSION["timestamp"] = date('l jS \of F Y h:i:s A');
}

?>

<h1>Honest Lauri's webshop</h1>

<p><a href="cart.php">Go to shopping cart</a>.</p>

<p>NSA is monitoring you since <?=$_SESSION["timestamp"];?></p>
<p>If you want any of these just call me ;)</p>
<ul>
<?php 
$results = $conn->query(
"SELECT id,name,price FROM lauri_products;");

while ($row = $results->fetch_assoc()) {
 ?>
 <li>
   <a href="description.php?id=<?=$row['id']?>">
      <?=$row['name']?></a>
      <?=$row['price']?>EUR
 </li>
 <?php
}
$conn->close();
?>
</ul>
<?php include "footer.php" ?>





