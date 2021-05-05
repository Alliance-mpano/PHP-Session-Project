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
        width: 90%;
    }
    label{
        width: 100%;
    }
    input[type=number],select{
        width: 90%;
    }
    input[type=submit]{
        margin-top: 3%;
    }
    table{
        overflow-x: scroll;
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
    require "./connection.php";
    $query = "SELECT DISTINCT * FROM stockproducts";
    $productsQuery = mysqli_query($connection,$query);
    ?>
    <form action="OutCreate.php" method="POST">
        <div class="row">
        <label for="product">Product</label>
            <select name="product" id="product">
                <?php 
                while($row = mysqli_fetch_assoc($productsQuery)){
                ?>
                <option value="<?php echo $row["productId"]?>"><?php echo $row["productName"]?></option>
                <?php } ?>
            </select>
        </div>
        <div class="row">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" required>
        </div>
        <div class="row">
            <input type="submit" value="Submit">
    </div>
    </form>
</body>
</html>