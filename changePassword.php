
<?php session_start();
if(!$_SESSION["userId"]){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
  
<form action="change.php" method="POST">
     <h1>Change Password for <?=$_SESSION["username"]?></h1>
     <div class="row">
     <input type="hidden" name="userid" value="<?=$_SESSION['userid']?>">
     <label for="password">Password</label>
       <input type="password" name="password" id="password">
     </div>
     <div class="row">
     <label for="new">New Password</label>
       <input type="password" name="newpassword" id="new" pattern=".{6,}">
     </div>   
   <div class="row">
     <label for="cpassword">Confirm Password</label>
     <input type="password" name="cpassword" id="cpassword">
 </div>
      <div class="row">
       <input type="submit" name="Change" value="Change password">
     </div>
     <a href="logout.php">Logout</a>
     <a href="landPage.php">Cancel</a>
      </form>

</body>
</html> 