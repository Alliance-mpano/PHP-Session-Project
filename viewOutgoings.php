<?php 
session_start();
if(!$_SESSION["userId"]){
    header("location: login.php");
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
<a href="createOutgoing.php" class = "create">Create Outgoing</a>
<?php
require "./connection.php";
$query = " SELECT sp.productName,so.registeredBy,so.productId,so.quantity,so.outgoingId,so.added_date,sp.brand from stockoutgoing so inner join stockproducts sp on so.productId=sp.productId";
$viewQuery = mysqli_query($connection,$query)or die (mysqli_error());

?>
<table>
    <tr>
        <th>Product Name</th>
        <th>Outgoing Quantity</th>
        <th>Added Date</th>
        <th>Brand</th>
        <th>Registered By</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
        while($row = mysqli_fetch_assoc($viewQuery)){
            $id = $row["registeredBy"];
            $userQuery = mysqli_query($connection,"SELECT username FROM stockusers WHERE userId = '$id'");
            $users = mysqli_fetch_array($userQuery);
            $user = $users[0];
        ?>
    <tr>        
        <td><?=$row["productName"]?></td>
        <td><?=$row["quantity"]?></td>
        <td><?=$row["added_date"]?></td>
        <td><?=$row["brand"]?></td>
        <td><?=$user?></td>
        <td><a class="update" href="updateOutgoingForm.php?id=<?=$row["outgoingId"]?>">Update</a></td>
        <td><a class="delete" href="deleteOutgoing.php?id=<?=$row["outgoingId"]?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>