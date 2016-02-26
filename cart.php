<?php
require_once "config.php";
include "header.php"; // This includes <html><head></head><body>
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$conn or die("Database connection failed:" . $conn->error);
$conn->query("set names utf8"); // Support umlaut characters

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // We are adding something to the cart
    $product_id = intval($_POST["id"]);
    if (array_key_exists($product_id, $_SESSION["cart"])) {
        $_SESSION["cart"][$product_id] += 1;
    } else {
        $_SESSION["cart"][$product_id] = 1;
    }
} else {
    // We are just checking out what we have in the cart
}

?>

<h2>Products in shopping cart</h2>
<p>

<ul>
<?php
$results = $conn->query(
"SELECT id,name,price FROM lauri_products;");

$results or die("Database query failed:" . $conn->error);

while ($row = $results->fetch_assoc()) {
  $product_id = $row['id'];
  if (array_key_exists($product_id, $_SESSION["cart"])) {
    $count = $_SESSION["cart"][$product_id];
    ?>
      <li>
        <?=$count;?> items of
        <a href="description.php?id=<?=$product_id;?>">
          <?=$row['name'];?></a>
          <?=$row['price'];?>EUR totals in <?= $row['price'] * $count; ?> EUR
        <form method="delete">
          <input type="hidden" name="id" value="<?=$product_id;?>"/>
          <input type="submit" value="Remove"/>
        </form>
      </li>
    <?php
  }
}
$conn->close();
?>
</ul>

<?php include "footer.php" ?>
