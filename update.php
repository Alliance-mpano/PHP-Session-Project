<?php
$id = $_POST["updateId"];
echo $id;
$product_Name = $_POST["product_Name"];
$brand = $_POST["brand"];
$supplier_phone =$_POST["supplier_phone"];
$supplier = $_POST["supplier"];
$host = "localhost";
$user = "root";
$database = "store_management";
$db_password = "mysql";
$connection = mysqli_connect($host, $user, $db_password, $database);
if(!$connection){
    die(mysqli_connect_error());
}
if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $supplier_phone))
{
 echo "Invalid number";
 return;
}
$query=mysqli_query($connection,"UPDATE stk_products SET product_Name = '$product_Name',brand ='$brand',supplier_phone='$supplier_phone',supplier='$supplier' WHERE productId = '$id' ");
if(!$query){
    die(mysqli_error());
}else{
    echo "Updated product successfully";
}
?>