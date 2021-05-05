<?php
session_start();
if(!$_SESSION["userId"]){
    header("location: login.php");
}
require "./connection.php";
$id = $_GET["id"];
echo $id;
$query = mysqli_query($connection,"DELETE FROM stockproducts WHERE productId = '$id'");
if(!$query){
    die(mysqli_error());
}else{
    // echo $id;
    echo "Deleted product from database";
}

?>