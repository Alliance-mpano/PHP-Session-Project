<?php
session_start();
if(!$_SESSION["role"]){
    header("location:login.php");
}
$id = $_SESSION["userId"];
require "./connection.php";
$quantity = $_POST["quantity"];
$product = $_POST["product"];
$query= "INSERT INTO stockoutgoing (productId, quantity, registeredBy) VALUES ('$product','$quantity','$id')";
$insertQuery = mysqli_query($connection,$query) or die (mysqli_error());
if($insertQuery){
    echo "Removed products from store";
    echo "<a href='viewOutgoings.php'>View All Outgoings</a>";
}
?>
