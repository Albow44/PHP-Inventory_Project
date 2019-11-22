<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
    }
   
?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<div class= "sidenav">
<ul>
  <li><a href="registration.php">Register</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="addproducts.php">Add Products</a></li>
  <li><a href="showproducts.php">Show Products</a></li>
  <li><a href="deleteproducts.php">Delete Products</a></li>
  <li><a href="passwd.php">Reset Password</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
  </div>

