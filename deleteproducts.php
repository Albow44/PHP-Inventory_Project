<?php
require('header.php');

if(session_status() === PHP_SESSION_NONE){
    session_start();
    }
    if ($_SESSION['username'] == null){
        header('Location: login.php');
        exit();
    }
    if($_SESSION['username'] != null){
        require('dbconnection.php');

        if(isset($_POST['productid'])){
            $deleteinventory = $_POST['productid'];
            $sql = "DELETE FROM Inventory WHERE id = '$deleteinventory'";
            $conn->query($sql);
        }

        $sql = "SELECT * FROM Inventory";
        $results = $conn->query($sql);
    }    
?>

<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="style.css">

    <title>Delete Products</title>

</head>
<body>
<div class="container">
   <div class="center">

 <table>
        <thead>
        <th COLSPAN="5"><h2>Delete Products from Inventory</h2></th>
        <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Cost</th>
        <th>In Stock</th>
        <th>Last Updated</th>
        <tbody>
        <?php
            if($results->num_rows > 0){
                while($row = $results->fetch_assoc()){
        ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_cost']; ?></td>
                        <td><?php echo $row['on_hand']; ?></td>
                        <td><?php echo $row['last_updated']; ?></td>  
                    </tr>
        <?php
                }
            }
        ?>
        </tbody>
        </thead>
       
</table>
<br>
<form action="" method="POST">
    <p>Enter product ID number for deletion:</p>
	<label for="productid">Product ID #</label>
	<input type="number" name="productid" min="0">
	<input type="submit" value="Submit">
<br>
<br>
<a href="registration.php" style="margin: 25px">If you are not yet registered, click here.</a> <br/>
<br>

</div>
        </div>
</form>

<style>
    form{
        width: 50%;
        margin: auto;
        padding: 20px 0px;
        position: relative;
        }
</style>  

<?php
require('footer.php');
?> 