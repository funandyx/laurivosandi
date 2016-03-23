<?php
require_once "config.php";
include "header.php" ?>
<a href="index.php">Back to product listing</a>
<?php
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" . $conn->connect_error);
$conn->query("set names utf8");
// This is orders.php, again beginning copy-pasted from description.php
$statement = $conn->prepare("SELECT * FROM `lauri_orders` WHERE `user_id` = ?");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);

// TODO: If $_SESSION["user"] is nonsense, redirect to index.php!
$statement->bind_param("i", $_SESSION["user"]);
if (!$statement->execute()) die("Failed to execute statement");
$results = $statement->get_result();
?>
<h1>Orders</h1>
<ul>
<?php
  while ($row = $results->fetch_assoc()) { ?>
    <li>
      <a href="orderdetail.php?id=<?= $row["id"]; ?>">
        Order #<?= $row["id"]; ?>
        <?= $row["created"]; ?>
        <?= $row["shipping_address"]; ?>
      </a>
    </li><?php
  }
?>
