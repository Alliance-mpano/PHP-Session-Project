<?php
session_start();
if(!$_SESSION["userId"]){
    header("location:changePassword.php");
}
$userid=$_SESSION['userId'];
$password=trim($_POST['password']);
$newPassword=$_POST['newpassword'];
$confirmedNewPassword=$_POST['cpassword'];
if(!$newPassword||!$confirmedNewPassword){
    die("Please enter the new password");
}
if(!($newPassword==$confirmedNewPassword)){
   echo " Please confirm the new Password";
}
else{
   $hashed=hash('SHA512',$password);
   include "connection.php";
   $query="SELECT * from stockusers WHERE userid='$userid' and password='$hashed'";
$exe=mysqli_query($connection,$query);
if(mysqli_num_rows($exe)==0){
   echo " The Current Password is wrong";
}
else{
   $hashed=hash("SHA512",$newPassword);
   $updateQuery="update stockusers set password='$hashed' WHERE userId='$userid'";
$execute=mysqli_query($connection,$updateQuery) or die (mysqli_error());
if($execute){
   echo "Changed succesfully";
   echo "<a href ='landPage.php'>View account</a>";
}}}
?>

