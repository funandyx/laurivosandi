<?php
require_once "config.php";
include "header.php" ?>
<a href="index.php">Back to product listing</a>
<?php

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters
$statement = $conn->prepare(
"SELECT `name`, `description`, `price` FROM" .
" `lauri_products` WHERE `id` = ?");
$statement->bind_param("i", $_GET["id"]);
$statement->execute();
$results = $statement->get_result();
$row = $results->fetch_assoc();
?>

<span style="float:right;"><?=$row["price"];?>EUR</span>
<h1><?=$row["name"];?></h1>

<p>
<?=$row["description"];?>
</p>

<form method="post" action="cart.php">
  <input type="hidden" name="id" value="<?=$_GET["id"];?>"/>
  <input type="hidden" name="count" value="1"/>
  <input type="submit" value="Add to cart"/>
</form>

<? include "footer.php" ?>























