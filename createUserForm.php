<?php
session_start();
if(!$_SESSION["userId"]){
    header("location:login.php");
}
if($_SESSION["role"]!=="Administrator"){
    die("Only Administrators are allowed to add new users");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="formResponsive.css">
</head>
<body>
    <div class="form">
        <h2>Join US</h2>    
        <form action="createAccount.php" method="POST">
            <div class="row">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>
            <div class="row">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>
            <div class="row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="row">
                <label for="gender">Gender</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female" class="special">Female</label>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male" class="special">Male</label>
            </div>
            <div class="row">
                <label for="role">Role</label>
                <select name="role" id="role">
                <?php
                require "./connection.php";
                $rolesQuery = mysqli_query($connection,"SELECT * FROM roles") or die (mysqli_error());
                
                while($row=mysqli_fetch_assoc($rolesQuery)){?>

                <option value="<?=$row["roleId"]?>"><?=$row["roleName"]?></option>
                <?php } ?>
                </select>
            </div>          
            <div class="row">
                <label for="telephone">Telephone</label>
                <input type="tel" name="telephone" id="telephone" required>
            </div>
            <div class="row">
                <label for="nationality">Nationality</label>
                <select name="nationality" id="nationality">
                <?php
                $countriesQuery = mysqli_query($connection,"SELECT * FROM nationalities");
                if($countriesQuery){
                while($row=mysqli_fetch_array($countriesQuery)){?>

                <option value="<?php echo $row["nationalityId"]?>"><?php echo $row["nationalityName"]?></option>
                <?php } }?>
                </select>
            </div>           
            <div class="row">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your Password" id="confirmPassword" required>
          </div>
            <div class="row">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" name="cpassword" placeholder="Confirm Password" id="confirmPassword" required>
            </div>           
            <div class="row">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>