<?php
session_start();
if(!$_SESSION["userId"]){
    header("location: login.php");
}
if(!$_SESSION["id"]){
    header("location:viewOutgoings.php");
}
require "./connection.php"; 
$quantity = $_POST["quantity"];
$product = $_POST["product"];
$outgoingId=$_POST["id"];
echo $outgoingId;
$query = "UPDATE stockoutgoing SET quantity = '$quantity' WHERE outgoingId = '$outgoingId'";
$updateQuery = mysqli_query($connection,$query);
if($updateQuery){
    echo "Updated outgoings successfully";
}else{
    die (mysqli_error());
}
?>