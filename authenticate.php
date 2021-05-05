<?php session_start();
// if(!$_SESSION["userId"]){
//     echo("First Login");
//     die ("<a href='login.php'>Login</a>");
// }
if(!$_SESSION["userId"]){
    header("location: login.php");
}
if($_SESSION["userId"]){
    header("location: landPage.php");
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
$password = trim($_POST["password"]);
$username = trim($_POST["username"]);
    echo "Connected to database successfully<br>";
    if( ($username =="") || ($password =="") ){
        die("Username and Password are required");
        }
    print_r($_POST);
    $password = hash("SHA512",$password);
    $query = " SELECT us.userId,us.firstName, us.lastName, us.gender,us.telephone,us.email,us.username,us.nationality, us.role,rol.roleName as role FROM stockusers us INNER JOIN roles rol ON us.role=rol.roleId WHERE us.username ='$username' AND us.password = '$password'";
    $login = mysqli_query($connection, $query) or die (mysqli_error());
    $loginUser = mysqli_fetch_assoc($login);
    if($loginUser == NULL){
        echo "Incorrect username or password";
        die("<a href='login.php'>Try again</a>");
    }else{
        $_SESSION["userId"]=$loginUser["userId"];
        $_SESSION["role"]=$loginUser["role"];
        echo $_SESSION["nationality"]= $loginUser["nationality"];
        $_SESSION["firstName"]=$loginUser["firstName"];
        $_SESSION["username"]=$loginUser["username"];
        $macaddress=exec('getmac');
        $macaddress=strtok($macaddress," ");
        $_SESSION['macAddress']=$macaddress;
        $ipaddress=getHostByName(gethostname());
        $_SESSION['ipAddress']=$ipaddress;
        $id = $_SESSION["userId"];
        echo $id;
        require('UserInfo.php');
        $y=new UserInfo();
        $osPlatform=$y ->get_os();
    $browser = $y->get_browser();
    echo $browser;
    
    echo $ipaddress;
    echo $macaddress;
        $_SESSION["browser"]=$browser;
        $_SESSION["osPlatform"]=$osPlatform;
     
        $detailsQuery = mysqli_query($connection,"INSERT INTO userinfo (ipAddress,macAddress,browser,osPlatform,user)VALUES ('$ipaddress','$macaddress','$browser','$osPlatform','$id')")or die(mysqli_error());
        if($_SESSION["userId"]){
            header("Location: landPage.php");
        }}
       ?>

</body>
</html>