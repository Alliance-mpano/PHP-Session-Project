<?php
session_start();
if(!$_SESSION["userId"]){
    header("location: login.php");
}
require "./connection.php";
$quantity = $_POST["quantity"];
$product = $_POST["product"];
$product = intval($product);
$id = $_SESSION["userId"];
echo $id;
echo $product;
var_dump( $_POST);
$query = "INSERT INTO stockinventory (productId, quantity,registeredBy) VALUES ('$product','$quantity','$id')";
$inventoryQuery = mysqli_query($connection,$query);
if($inventoryQuery){
    echo "Added inventory successfully";
    echo "<a href='viewInventories.php'>View Inventories</a>";
}else{
    echo "Inventory not added".mysqli_error();
}
// <a href=""></a>
?>