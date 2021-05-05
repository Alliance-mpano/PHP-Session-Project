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
input{
    height: 40px;
    width: 40%;
    margin-bottom: 3%;
    border: none;
    box-shadow: #f1f1f1 1px 3px 2px 1px;
    font-size: 1em;
    padding-left: 5px;
}
input[type=submit]{
    margin: auto;
    background-color: grey;
    color: white;
    font-size: 1.2em;
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
    input[type=text],input[type=tel]{
        width: 80%;
    }
    input[type=submit]{
        margin-top: 3%;
    }
}
@media only screen and (min-width: 760px) and (max-width:1024px){
    form{
        width: 60%;
    }
}
    </style>
</head>
<body>
<?php
     require "./connection.php";
     $id = $_GET["id"];
     echo $id;
     $query = mysqli_query($connection, "SELECT * FROM storeproducts WHERE productId= '$id'");
     if(!$query){
         echo ("error");
     }
     $row = mysqli_fetch_assoc($query);
    ?>
 <form action="update.php" method="POST">
        <h2>Update Product Information</h2>
        <div>
           <input type="hidden" name="updateId" value="<?=$row["productId"]?>"> 
        </div>
        <div class="row">   
            <label for="product_Name">Product Name</label>
            <input type="text" name="product_Name" value ="<?php echo $row["productName"]?>" id="product_Name" required>
        </div>
        <div class="row">
            <label for="brand">Brand</label>
            <input type="text" name="brand" value ="<?php echo $row["brand"]?>" id="brand" required>
        </div>
        <div class="row">
            <label for="supplier_phone">Supplier Phone</label>
            <input type="tel" value ="<?php echo $row["supplierPhone"]?>" name="supplier_phone" id="supplier_phone" required>
        </div>
        <div class="row">
            <label for="supplier">Supplier</label>
            <input type="text" value ="<?php echo $row["supplier"]?>" name="supplier" id="supplier" required>
        </div>
        <div class="row">
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>
