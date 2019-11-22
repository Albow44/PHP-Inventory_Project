<?php
require('header.php');
require('dbconnection.php');

if(session_status() === PHP_SESSION_NONE){
    session_start();
    }
    if ($_SESSION['username'] == null){
        header('Location: login.php');
        exit();
    }

    $error = "";
    $username = $_SESSION['username'];
    $remote_address = $_SERVER['REMOTE_ADDR'];
    $password = $_POST['pword'];
    $confirmation_password = $_POST['cpword'];
    $hash = password_hash($password,PASSWORD_BCRYPT);


        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['old_pass'] != null) {
         
            $form_password = $_POST['old_pass'];
            require('dbconnection.php');
            $stmt = $conn->prepare("SELECT password FROM Users WHERE username=? LIMIT 1");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    $stored_hash = $row['password'];
                }
            } else {
                $error = "Invalid Password";
            }
            if (password_verify($form_password,$stored_hash)){
                if ($password == $confirmation_password){
                    if ($password == $form_password){
                        $error = "Cannot reuse old password.";
                    } else {
                        $stmt2 = $conn->prepare("UPDATE Users SET password =? WHERE username =?"); 
                        $stmt2->bind_param("ss", $hash, $username); 
                        $stmt2->execute(); 
                        header('Location: login.php');


                       unset($_SESSION['username']);
                        session_destroy();
                        $stmt2->close();
                    }
                    
                } else {
                    $error = "Passwords do not match.";
                }
            } else if (!password_verify($form_password,$stored_hash)){
                $error = "Invalid Password";
            }
            $stmt->close();
            $conn->close();   
        }

?>
<!DOCTYPE HTML>
    <html>      
<head>
    <link rel="stylesheet" href="style.css">
        <title>Reset Password</title>
</head>
<body>
<div class="container">
  <div class="center">

    <center><h1 style= "color:white"> Reset Your Password </h1></center>

    <form action="" method="POST">

        <br>
            <label>Username:</label> <input style="margin: 1px" type="text" name="uname">
        <br>
            <label>Password:</label> <input  type="password" name="old_pass">
        <br>
            <label>New Password:</label> <input type="password" name="new_pass">
        <br>
            <label>Confirm Password:</label> <input type="password" name="con_pass">
        <br>
        <br>
            <input style="margin: 8px" type="submit" value="Submit Change">
        <br>

    <a href="registration.php" style="margin: 25px">If you are not yet registered, click here.</a> <br/>
        <br>
    <a href="login.php" style="margin: 25px">Login</a> <br/>
        <br>
</div>
 </div>
    </form>

<br />


<?php
require('footer.php');        
?>