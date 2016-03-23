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

<p>

<!-- We could actually move login and registration buttons to
     separate nav.php file and include it here -->

<?php

if (array_key_exists("user", $_SESSION)) {
    // In case we put user id in the $_SESSION["user"] we need
    // to perform another SQL query to get the full name of the user:
    $results = $conn->query(
        "SELECT * FROM lauri_users
        WHERE id = " . $_SESSION["user"]);
    $row = $results->fetch_assoc();
    echo "Hello " . $row["salutation"] . " ";
    echo $row["first_name"] . " ";
    echo $row["last_name"];

    // Oh how I'd like to do just:
    // print "Hello %(salutation)s %(first_name)s %(last_name)s" % $row

    ?> <a href="logout.php">Log out</a><?php
} else {
   // Otherwise offer login fields and button
   ?>
   <form action="login.php" method="post">
     <input type="text" name="user"/>
     <input type="password" name="password"/>
     <input type="submit" value="Log in!"/>
   </form><?php
} ?>

<a href="registration.php">Sign up!</a>. <a href="cart.php">Go to shopping cart</a>.</p>

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





