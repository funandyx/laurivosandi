<?php
// This is placeorder.php, this shall basically move cart contents to database as a new order
// Copypaste from regsubmit.php follows:
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters

// This inserts row to orders table
$statement = $conn->prepare("INSERT INTO `lauri_orders` (`user_id`) VALUES (?)");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
$statement->bind_param("i", $_SESSION["user"]); // User ID is the logged in user's ID
if (!$statement->execute()) {
    die("Execute failed: (" . $statement->errno . ") " . $statement->error);
}
$order_id = $conn->insert_id; // This contains the ID for the inserted order

// This inserts rows to order_products table
$statement = $conn->prepare(
    "INSERT INTO `lauri_order_products` (`order_id`, `product_id`, `count`) VALUES (?,?,?)");
if (!$statement) die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
foreach ($_SESSION["cart"] as $product_id => $count) {
    $statement->bind_param("iii", $order_id, $product_id, $count);
	if (!$statement->execute()) {
		die("Execute failed: (" . $statement->errno . ") " . $statement->error);
	}
}

// Here of course we should reset shopping cart:
$_SESSION["cart"] = array();
header('Location: orders.php'); // This should redirect to orders page (which we haven't created yet)

?>



