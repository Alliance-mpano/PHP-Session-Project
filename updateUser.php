<?php
session_start();
if(!$_SESSION["userId"]){
    header("location:updateUserForm.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    require "./connection.php";
    echo "Connected to database successfully<br>";
    $id =$_SESSION["userId"];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender =$_POST["gender"];
    $telephone = $_POST["telephone"];
    $nationality = $_POST["nationality"];
    
    print_r($_POST);
    // if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //     echo("Valid");
    // }else{
    //     echo "Invalid";
    //     return;
    // }
    if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $telephone))
    {
     echo "Invalid number";
     return;
    }
    $query = "UPDATE stockusers SET firstName= '$firstName',lastName='$lastName',gender = '$gender', telephone='$telephone',nationality= '$nationality' WHERE  userId = '$id'";
    $updateQuery = mysqli_query($connection, $query) or die (mysqli_error());
    echo "Updated User Information";
    
?>
<a href="landPage.php">View account</a>
</body>
</html>
