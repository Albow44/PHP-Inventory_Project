
<?php

require('header.php');
$last_updated = date('Y-m-d H:i:s');
//require(header.php);

if(session_status() === PHP_SESSION_NONE){
    session_start();
    }
    if ($_SESSION['username'] == null){
        header('Location: login.php');
        exit();
    }

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $product_name = $_POST['product'];
    $product_cost = $_POST['cost'];
    $on_hand = $_POST['onhand'];
}
        require('dbconnection.php');
        $sql = "INSERT INTO Inventory (product_name, product_cost, on_hand, last_updated) VALUES ('$product_name','$product_cost','$on_hand','$last_updated')";

        $result = $conn->query($sql);
        
        if($result){

            echo "<center><h2>Products added successfully</h2></center>";
        }
      
?>
<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" href="style.css">
    <title>Add Products</title>
    </head>

<div class="container">
  <div class="center">


<form action="" method="POST">
<h3>Add Products to Inventory</h3>
<br>
<br>
<label>Product:</label><input style="margin: 1px" type="text" name="product">
<br>
<label>Cost:</label><input style="margin: 1px" type="text" name="cost">
<br>
<label>Product On-Hand:</label><input style="margin: 1px" type="text" name="onhand">
<br>
<br />
<input style="margin: 8px" type="submit" value="Submit">
<button style="margin: 8px" type="reset">Reset</button>
<br>
<br>
<a href="logout.php" style="margin: 25px">Click here to Logout</a> 
<br>
<br>
<a href="registration.php" style="margin: 25px">If you are not yet registered, click here.</a> <br/>
<br>

</div>
    </div>

</form>

<?php
require('footer.php');
?>