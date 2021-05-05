<?php
$host = "localhost";
$user = "root";
$database = "store_management";
$db_password = "";
$connection = mysqli_connect($host, $user, $db_password, $database);
if(!$connection){
    die(mysqli_connect_error());
}
?>