<?php
session_start();
if(!$_SESSION["userId"]){
    header("location:login.php");
}
if($_SESSION["role"]!=="Administrator"){
    die("Only ADMINISTRATORS can view All users");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="managment.css">
</head>
<body>
<a href="createUserForm.php">Add User</a>
<?php
require "./connection.php";
$query = mysqli_query($connection,"SELECT userId,firstName,lastName,gender,telephone,email,username,nationalityId,nationalityName as nationality FROM stockusers  INNER JOIN nationalities ON nationality = nationalityId")or die( "Error ".mysqli_error());

?><a href="createUserForm.php">Add User</a>
<table border = 2px solid black;border-collapse= collapse>
    <tr>
         <th>NO</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Role</th>
         <th>Gender</th>
         <th>Nationality</th>
         <th>Telephone</th>
         <th>Username</th>
    </tr>
<?php
while($row = mysqli_fetch_assoc($query)){
    $id = $row["userId"];
    echo $id;
    $roleQuery = mysqli_query($connection,"select roles.roleName from roles inner join stockusers us on us.role = roles.roleId where userId = '$id'")or die(mysqli_error());
    $role=mysqli_fetch_array($roleQuery);
    $userRole =$role[0];
?>

<tr>

     <td><?=$row["userId"]?></td>
     <td><?=$row["firstName"]?></td>  
     <td><?=$row["lastName"]?></td>
     <td><?=$row["email"]?></td>
     <td><?=$userRole?></td>
     <td><?=$row["gender"]?></td> 
     <td><?=$row["nationality"]?></td>
     <td><?=$row["telephone"]?></td>
     <td><?=$row["username"]?></td>
     

     </tr>
<?php } ?></table>
  
</body>
</html>
