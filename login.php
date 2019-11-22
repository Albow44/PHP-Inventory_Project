<?php
require('header.php');
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
if ($_SESSION['username'] != null){
    echo "You are logged in" ;
} 
    $cookie_name = "user";
    $cookie_value = "You";
    setcookie($cookie_name, $cookie_value, time() + (180), "/");
    if(!isset($_COOKIE[$cookie_name])) {
        unset($_SESSION['username']);
        session_destroy();
        header('Location: login.php');
    }
if ($_SERVER["REQUEST_METHOD"] == "POST"  && !empty($_POST['uname'])) {
        
    // POST variables
    $form_username = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
    $form_password = $_REQUEST['pword'];

    // Remote IP Address
    $current_location = $_SERVER['REMOTE_ADDR'];

    // Database Connection
    require('dbconnection.php');

    // Query database
    $sql = "SELECT * FROM Users WHERE username = '$form_username';";
    $result = $conn->query($sql);
    $stored_hash = "";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $stored_username = $row['username'];
            $stored_hash = $row['password'];
            // get last login location from database
            $stored_location = $row['location'];
        }
    } else {
        echo "Invalid log in, please try again.<br />";
    }

    if (password_verify($form_password, $stored_hash)) {
        $_SESSION['username'] = $form_username;

        // Compare last login IP to current login IP address
        if ($current_location != $stored_location){
            $location_message = "You are logging in from a different location <br />";

            // Update new IP address location
            $sql = "UPDATE Users SET location = '$current_location' WHERE username = '$stored_username';";
            $result = $conn->query($sql);
        }

    }
    //Close database connection
    $conn->close();
    //
    if($_SESSION['username'] != null){
        header("Location: addproducts.php");
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    </head>

<body>

<div class="container">
  <div class="center">

<?php

if ($_SESSION['username'] != null){

    echo "<center><h2>You are logged in as " . $_SESSION['username'];

    echo "<br /></center></h2>";
}
?>
    <form action="" method="POST">
    <h3>Login</h3>
    <br>

    <label>Username:</label> <input style="margin: 1px" type="text" name="uname">
        <br>
    <label>Password:</label> <input  type="password" name="pword">
        <br>
     <br>
    <input style="margin: 8px" type="submit" value="Login">
    <button style="margin: 8px" type="reset">Reset</button>
     <br />
        <br />

    <a href="registration.php" style="margin: 25px">If you are not yet registered, click here.</a> <br/>
        <br>

    </div>
        </div>
    </form>

<?php
require('footer.php');
?>