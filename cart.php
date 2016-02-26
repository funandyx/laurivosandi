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

<ul>
<?php
$results = $conn->query(
"SELECT id,name,price FROM lauri_products;");

while ($row = $results->fetch_assoc()) {
  if (array_key_exists($row['id'], $_SESSION["cart"])) {
    ?>
      <li>
        <?=$_SESSION["cart"][$row['id']];?> items of
        <a href="description.php?id=<?=$row['id']?>">
          <?=$row['name']?></a>

          <?=$row['price']?>EUR
      </li>
    <?php
  }
}
$conn->close();
?>
</ul>

<?php include "footer.php" ?>
