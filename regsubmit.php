<?php
require_once "config.php";
include "header.php";
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:" .
    $conn->connect_error);
$conn->query("set names utf8");

$statement = $conn->prepare(
"INSERT INTO `lauri_users` (
    `email`,
    `password`,
    `first_name`,
    `last_name`,
    `phone`,
    `dob`,
    `salutation`,
    `vatin`,
    `company`,
    `country`,
    `address`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$statement->bind_param("sssssssssss",
    $_POST["email"],
    $_POST["password"],
    $_POST["first_name"],
    $_POST["last_name"],
    $_POST["phone"],
    $_POST["dob"],
    $_POST["salutation"],
    $_POST["vatin"],
    $_POST["company"],
    $_POST["country"],
    $_POST["address"]);

$statement->execute() || die("Execute failed: (" . $statement->errno . ") " . $statement->error);

?>
