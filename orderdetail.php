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
"SELECT
  `lauri_order_products`.`id` AS `order_product_id`,
  `lauri_order_products`.`product_id` AS `product_id`,
  `lauri_products`.`name` AS `product_name`,
  `lauri_order_products`.`unit_price` AS `order_product_unit_price`,
  `lauri_order_products`.`count` AS `order_product_count`,
  `lauri_order_products`.`unit_price` * `lauri_order_products`.`count` AS `subtotal`
FROM
  `lauri_order_products`
JOIN
  `lauri_products`
ON
  `lauri_order_products`.`product_id` = `lauri_products`.`id`
WHERE
  `lauri_order_products`.`order_id` = ?
");
// This is orderdetail.php
// The SQL code above is copy-paste from wiki, PHP code above is copy-paste from description.php
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_GET["id"]); // TODO: Check that order belongs to $_SESSION["user"] !!!
$statement->execute();
$results = $statement->get_result();
?>
<h1>Order details</h1>
<ul>
<?php
  while ($row = $results->fetch_assoc()) { ?>
    <li>
      <?= $row["product_name"]; ?>
      <?= $row["order_product_count"]; ?>x
      <?= $row["order_product_unit_price"]; ?>EUR
    </li><?php
  }
?>
