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
        $sql = "SELECT * FROM Inventory";
       
        $results = $conn->query($sql);
       
    }        
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="style.css">

    <title>Products</title>

</head>
<body>
    

<div class="container">

 <table class="center">
        <thead>
        <th COLSPAN="5"><h2>Product Inventory</h2></th>
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
 </div>
       

<?php
require('footer.php');
?>     
