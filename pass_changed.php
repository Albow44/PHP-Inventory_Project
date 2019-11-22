<?php

require('header.php');
session_start();

    
    $old_user = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    session_destroy();

    if (empty($valid_user)){

echo "<center><h2>Your password has been Reset.</h2></center>";

}
?>

<!DOCTYPE html>
<html>

    <head>

    <link rel="stylesheet" href="style.css">
    <title>Reset</title>
    </head>

<body>

<div class="container">
  <div class="center">
<form action="" method="POST">

<h3>Login</h3>
<br>
<br>

<a href="login.php" style="margin: 25px">Click here to Login</a> <br/>
<br>
</div>
    </div>

</form>
<?php
require('footer.php');
?>