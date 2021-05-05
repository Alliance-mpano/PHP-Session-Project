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
<a href="createInventory.php">Create Inventory</a>
<?php
require "./connection.php";
$query = " SELECT sp.productName,si.registeredBy,si.productId,si.quantity,si.inventoryId,si.added_date,sp.brand from stockinventory si inner join stockproducts sp on si.productId=sp.productId";
$viewQuery = mysqli_query($connection,$query)or die (mysqli_error());

?>

<table>
    <tr>
        <th>Product Name</th>
        <th>Incoming Quantity</th>
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
        <td><?php echo $row["productName"]?></td>
        <td><?php echo $row["quantity"]?></td>
        <td><?php echo $row["added_date"]?></td>
        <td><?php echo $row["brand"]?></td>
        <td><?=$user?></td>
        <td><a class="update" href="updateInventoryForm.php?id=<?=$row["inventoryId"]?>">Update</a></td>
        <td><a class="delete" href="deleteInventory.php?id=<?=$row["inventoryId"]?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>