<?php
require_once "config.php";
include "header.php"; // This includes <html><head></head><body>
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8"); // Support umlaut characters

$product_id = intval($_POST["id"]);
if (array_key_exists($product_id, $_SESSION["cart"])) {
    $_SESSION["cart"][$product_id] += 1;
} else {
    $_SESSION["cart"][$product_id] = 1;
}

?>

<h2>Products in shopping cart</h2>
<p>
<?php var_dump($_SESSION["cart"]); ?>

<?php include "footer.php" ?>
