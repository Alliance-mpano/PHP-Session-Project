<?php
session_start();
require "./connection.php";
$product_Name = $_POST["product_Name"];
$brand = $_POST["brand"];
$id = $_SESSION["userId"];
$supplierphone =$_POST["supplier_phone"];
$supplier = $_POST["supplier"];
print_r($_POST);
if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $supplierphone)){
 echo "Invalid number";
 return;
}
$createSql = "INSERT INTO stockproducts (productName,brand,supplierPhone,supplier,registeredBy) VALUES ('$product_Name','$brand','$supplierphone','$supplier','$id')";
$createQuery  = mysqli_query($connection,$createSql);
if($createQuery){
    echo "Added new product to the database successfully";
}else{
    echo "Unable to add new product".mysqli_error();
}
echo "<a href='readProducts.php'>View All Products</a>"
?>