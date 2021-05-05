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
<?php
require "./connection.php";
$query = mysqli_query($connection,"select sp.productId,sp.productName,sp.brand,sp.supplierPhone,sp.supplier,sp.registeredBy, username from stockproducts sp inner join stockusers on sp.registeredBy = userId")or die( "Error ".mysqli_error());
?>
<a href="registerProduct.php">Add Product</a>
<table>
    <tr>
         <th>NO</th>
         <th>product_Name</th>
         <th>brand</th>
         <th>supplier_phone</th>
         <th>supplier</th>
         <th>Registered By</th>
         <th>Edit</th>
         <th>Delete</th>
        
    </tr>
<?php
while($row = mysqli_fetch_assoc($query)){
    
?>

<tr>

     <td><?=$row["productId"]?></td>
     <td><?=$row["productName"]?></td>  
     <td><?=$row["brand"]?></td>
     <td><?=$row["supplierPhone"]?></td> 
     <td><?=$row["supplier"]?></td>
     <td><?=$row["username"]?></td>
     <td><a class="update" href="updateProductForm.php?id=<?=$row["productId"]?>">Update</a></td>
    <td><a class="delete" href="deleteProduct.php?id=<?=$row["productId"]?>">Delete</a></td>
     </tr>
<?php } ?>
</table>    
</body>
</html>


