<?php
session_start();

if (!array_key_exists("cart", $_SESSION)) {
    $_SESSION["cart"] = array();
    // Here we store product it -> count mapping
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="Introduction to this guy's website">
    <title>This goes into the titlebar</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/main.js"></script>
  </head>
  <body>
    <div id="content">
