<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}
body{
    background-color: rgb(235, 238, 243);
}
form{
    border-radius: 10px;
    width: 45%;
    background-color: rgb(204, 205, 206);
    margin: auto;
    margin-top: 3%;
    padding: 20px 0px 20px 40px;
}
input[type=number],select{
    height: 40px;
    width: 45%;
    margin-bottom: 3%;
    border: none;
    box-shadow: #f1f1f1 1px 2px 1px 1px;
}
select{
    font-size: 1em;
}
input[type=submit]{
    margin: auto;
    background-color: grey;
    color: white;
    font-size: 1.2em;
    height: 40px;
    width: 40%;
}
label{
    width: 40%;
    display: inline-block;
    line-height: 40px;
}
@media only screen and (max-width:760px) {
    form{
        width: 80%;
    }
    label{
        width: 100%;
    }
    input[type=number],select{
        width: 80%;
    }
    input[type=submit]{
        margin-top: 3%;
    }
}
@media only screen and (min-width: 760px) and (max-width:1024px){
    form{
        width: 70%;
    }
}
    </style>
</head>
<body>
<?php
session_start();
if(!$_SESSION["role"]){
    header("location:login.php");
}
require "./connection.php";
if(!$_GET["id"]){
    header("location:viewInventories.php");
}
$id = $_GET["id"];
echo $id;
$query = "select sp.productName,si.productId,si.quantity,si.inventoryId,si.added_date from stockinventory si inner join stockproducts sp on si.productId=sp.productId where inventoryId ='$id'";
$readQuery = mysqli_query($connection, $query) or die (mysqli_error());
$row = mysqli_fetch_assoc($readQuery);
$_SESSION["inventoryId"]=$row["inventoryId"];
?>
<form action="updateInventory.php" method="POST">
        <h2>Update Inventory</h2>
       
        <div class="row">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value = "<?= $row["quantity"]?>" id="quantity" required>
        </div>
        <div class="row">
            <label for="product">Product</label>
            <select name="product" id="product">
                <option value="<?= $row["productId"]?>"><?= $row["productName"]?></option>
                <?php
                $current = $row["productId"];
                echo $current;
                $productQuery= mysqli_query($connection, "SELECT productId , productName FROM stockproducts WHERE productId != '$current'");
                while($product= mysqli_fetch_assoc($productQuery)){
                ?>
                <option value="<?= $product["productId"]?>"><?= $product["productName"]?></option>
                <?php } ?>
            </select>
        </div>
        <div class="row">
            <input type="submit" value="Submit">
        </div>
    </form>

</body>
</html>