<?php
session_start();
if(!$_SESSION["userId"]){
    header("location: login.php");
}
require "./connection.php";
if(!$connection){
    die(mysqli_connect_error());
}  
$id = $_GET["thisID"];
echo("Connected to DB successfully<br>");
$deleteSql = "DELETE FROM stk_users WHERE userId = '$id'";
$deleteQuery = mysqli_query($connection,$deleteSql);
if($deleteQuery){
    echo "<br>Deleted user from the system successfully.";
}else{
    echo "Unable to delete user from the system";
}

?>