<?php
session_start();
if(!$_SESSION["inventoryId"]){
    header("location:updateInventoryForm.php");
}
require "./connection.php";
$quantity = $_POST["quantity"];
$product = $_POST["product"];
$inventory_id=$_SESSION["inventoryId"];
echo $inventory_id;
$query = "UPDATE stockinventory SET quantity = '$quantity' WHERE inventoryId = '$inventory_id'";
$updateQuery = mysqli_query($connection,$query);
if($updateQuery){
    echo "Updated inventory successfully";
}else{
    die (mysqli_error());
}
?>