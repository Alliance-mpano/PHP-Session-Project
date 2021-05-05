<?php
session_start();
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
    <title>Document</title>
    <link rel="stylesheet" href="landPage2.css">
</head>
<body>
    <?php
    $id = $_SESSION["userId"];
    require "./connection.php";
    $sql = " SELECT us.firstName, us.lastName, us.gender,us.telephone,us.email,us.username, us.role,rol.roleName as role FROM stockusers us INNER JOIN roles rol ON us.role=rol.roleId WHERE us.userId = '$id'";
    $query = mysqli_query($connection,$sql) or die (mysqli_error());
    $row = mysqli_fetch_assoc($query);
    $nationalityId = $_SESSION["nationality"];
    $nationalityquery = mysqli_query($connection,"SELECT nationalityName FROM nationalities WHERE nationalityId = '$nationalityId'");
    $nationalityArray = mysqli_fetch_array($nationalityquery);
    $nationality=$nationalityArray[0];
    ?>
    <nav>
    <a href="changePassword.php">Change Password</a>
<a href="updateUserForm.php">Edit Information</a>
    <?php

if($row["role"]==="Administrator"){
    ?>
    <a href="createUserForm.php">Add Users</a>
    <a href="readUsers.php">View Users</a>
    
    <?php
}
if($row["role"]==="Manager"){
?>
<a href="registerProduct.php">Add Product</a>

<?php } ?>
<a href="readProducts.php">View Products</a>
<a href="createInventory.php">Create Inventory</a>
<a href="createOutgoing.php">Create Outgoing</a>

</nav>
    <div class="row">
    <h2>Welcome, <?= $_SESSION["role"]?> <?=$_SESSION["firstName"]?></h2>
<h3>Account Information</h3>
<p>First Name: <?=$row["firstName"]?></p>
<p>Last Name: <?=$row["lastName"]?></p>
<p>Email: <?=$row["email"]?></p>
<p>Role: <?=$row["role"]?></p>
<p>Gender: <?=$row["gender"]?></p>
<p>Nationality: <?=$nationality?></p>
<p>Telephone: <?=$row["telephone"]?></p>
<p class ="username">Username: <?=$row["username"]?></p>
<a href="logout.php" class ="logout">Logout</a>

</div>
</body>
</html>