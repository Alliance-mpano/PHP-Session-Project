<?php
require "./connection.php";
if($connection){
    echo "Connected to database successfully<br>";
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST["email"];
    $gender =$_POST["gender"];
    $telephone = $_POST["telephone"];
    $nationality = $_POST["nationality"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $role = $_POST["role"];
    print_r($_POST);
    $password = hash("SHA512",$password);
    $createSql = "insert into stockusers (firstName,lastName,telephone,gender,username,email,password,nationality,role) values ('$firstName','$lastName','$telephone','$gender','$username','$email','$password','$nationality','$role')" ;
    $insertQuery = mysqli_query($connection,$createSql);
    if($insertQuery){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo("Valid");
        }else{
            echo "Invalid";
            return;
        }
        if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $telephone))
        {
         echo "Invalid number";
         return;
        }
        echo "Created new user successfully";
        echo "<a href='login.php'>Login</a>";
    }else{
        echo "error ".mysqli_connect_error();
    }
}else{
    die(mysqli_connect_error());
}

?>