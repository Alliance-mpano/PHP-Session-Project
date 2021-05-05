<?php
session_start();
if($_SESSION["userId"]){
    header("Location:landPage.php");
}else{
    $_SESSION["userId"]="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width==, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="authenticate.php" method="POST">
    <h2>Login</h2>
    <div class="row">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        </div>
        <div class="row">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        </div>
        <div class="row">
        <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>