
<?php

$servername = "localhost";
$username = "aaumiller66";
$password = "southhills#";
$dbname = "aaumiller66";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$pass = htmlspecialchars($_POST['password']);
$cpass = htmlspecialchars($_POST['cpassword']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

$goodUser = false;
$goodPass = false;
$goodEmail = false;

?>

<!DOCTYPE HTML>
    <html>      
<head>
    <link rel="stylesheet" href="style.css">
        <title>Account Registration Page</title>
</head>
<body>

<div class="container">
    <div class="center">

<form action ="" method="POST">
<h3>Register Account</h3>
<br>
<br>
    <label>Username</label>
    <input type="text" placeholder="Username" name="username" />

<?php

$sqlUser = "SELECT username FROM Users WHERE username=$user";
$result = mysqli_query($conn, $sqlUser);

if ($username == ""){
   // echo "Please enter a username.";
} 
elseif (mysqli_num_rows($result) == 1){
    echo "Username already exists! Try a different username.";
} 
else $goodUser = true;
?>

<br/>

    <label>Password</label>
    <input type="password" placeholder="Password" name="password">

<?php
    if ($pass == ""){
        //echo "Please enter a password.";
    } else $goodPass = true;
?>
<br />

    <label>Confirm Password</label>
    <input type="password" placeholder="Confirm Password" name="cpassword">
<?php
    if ($cpass == ""){
        //echo "Confirm password.";
        $goodPass = false;
    } 
    elseif ($pass === $cpass){
        $goodPass = true;
    }
    else {
        echo "Passwords do not match.";
        $goodPass = false;
    }
?>
<br />

    <label>Email</label>
    <input type="text" placeholder="Email" name="email"/>

<?php

$sqlEmail = "SELECT email FROM Users WHERE email=$email";
$result2 = mysqli_query($conn, $sqlEmail);

if ($email == ""){
    //echo "Enter a valid email address.";
}
elseif (mysqli_num_rows($result2) == 1){
    echo "Email already exists! Enter a different email.";
} 
else $goodEmail = true;
?>
<br />

<h4>Please click the Submit button to continue.<h4>

    <input type="submit" text="Submit" name="submit" action=""/>
<br />
<br>
    <a href="login.php" style="margin: 25px">Returning users please Login here.</a> <br/>
</form>
</div>
    </div>
<br />

<?php
if ($goodUser && $goodPass && $goodEmail){
    $encryptedPass = password_hash($pass, PASSWORD_BCRYPT);
    $sql = "INSERT INTO Users (username, password, email)
    VALUES('$username', '$encryptedPass', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New account created successfully! Welcome aboard!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php
require('footer.php');
?>