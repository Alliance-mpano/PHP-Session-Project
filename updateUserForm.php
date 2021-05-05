<?php session_start();
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
input[type=text],input[type=email],input[type=tel],select {
    height: 40px;
    width: 40%;
    margin-bottom: 3%;
    border: none;
    box-shadow: #f1f1f1 1px 3px 2px 1px;
    font-size: 1em;
    padding-left: 20px;
}
input[type=submit]{
    margin: auto;
    background-color: grey;
    color: white;
    font-size: 1.2em;
    width: 40%;
    height: 40px;
}
label:not(.special){
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
    $id = $_SESSION["userId"];
    // echo $id;
    $query = mysqli_query($connection,"SELECT su.userId, su.firstName,su.role, su.lastName, su.gender, su.telephone, su.email, su.username, ctr.nationalityId,ctr.nationalityName as nationality FROM stockusers su INNER JOIN nationalities ctr ON su.nationality=ctr.nationalityId WHERE su.userId ='$id'") or die(mysqli_error());
    $row = mysqli_fetch_assoc($query);
    $initial = $row["nationalityId"];
    echo $row["nationality"];
    $InitialRole = $row["role"];
    echo $InitialRole;
    ?>
    <form action="http://localhost\ProjectPHP\updateUser.php" method="POST">
        <div class="row">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" value="<?php echo $row["firstName"]?>" id="firstName" required>
        </div>
        <div class="row">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" value ="<?php echo $row["lastName"]?>" id="lastName" required>
        </div>
        <div class="row">
            <label for="email">Email</label>
            <input type="email" readonly name="email" value="<?php echo $row["email"]?>" id="email" required>
        </div>
        <div class="row">
        <label for="gender">Gender</label>
            <?php
            if($row["gender"]=="female"){?>            
            <input type="radio" id="female" checked name="gender" value="female">
            <label for="female" class="special">Female</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male" class="special">Male</label>
            <?php }else{ ?>           
            <input type="radio" id="female" name="gender" value="female">
            <label for="female" class="special">Female</label>
            <input type="radio" id="male" checked name="gender" value="male">
            <label for="male" class="special">Male</label>
            <?php } ?>
        </div>
        <!-- <div class="row"> -->
                <!-- <label for="role">Role</label>
                <select name="role" id="role"> -->
                <?php
                // $rolesQuery = mysqli_query($connection,"SELECT * FROM roles") or die (mysqli_error());
                
                // while($roleRow=mysqli_fetch_assoc($rolesQuery)){?>

                 <!-- <option value="<?=$roleRow["roleId"]?>"><?=$roleRow["roleName"]?></option> -->
                <?php
                //  }
                 ?>
                <!-- </select> -->
            <!-- </div>           -->
        <div class="row">
            <label for="telephone">Telephone</label>
            <input type="tel" name="telephone" value="<?php echo $row["telephone"]?>" id="telephone" required>
        </div>
        <div class="row">
        <label for="nationality">Nationality</label>
                <select name="nationality" id="nationality">
                    <option value="<?=$initial?>"><?=$row["nationality"]?></option>
                <?php
           
            $countries = mysqli_query($connection,"SELECT * FROM nationalities WHERE nationalityId != '$initial'");
            while($countriesValue= mysqli_fetch_assoc($countries)){
            ?>
        <option value="<?php echo $countriesValue["nationalityId"]?>"><?php echo $countriesValue["nationalityName"]?></option>
        <?php }
        ?>
        

                </select>
        </div>           
        <div class="row">
            <label for="username">Username</label>
            <input type="text" readonly name="username" value="<?php echo $row["username"]?>" id="username" placeholder="Username" required>
        </div>
        
        <div class="row">
            <input type="submit" value="Submit">
        </div>
    </form>
    </body>
</html>