<?php
require("../connection.php");
$username=$_POST['username'];
$password=$_POST['password'];

$select="select *from stockUsers where username='$username' and password='$password';";
$sendselect=mysqli_query($connection,$select);
if(!$sendselect){
    echo "invalid username or password";
}
else{
    session_start();
    $row=mysqli_fetch_assoc($sendselect);
    header('location: http://localhost/stockManagement/landingpage.php');
    $_SESSION['userId']=$row['userId'];
    $_SESSION['firstName']=$row['firstName'];
    $_SESSION['lastName']=$row['lastName'];
    $_SESSION['telephone']=$row['telephone'];
    $_SESSION['gender']=$row['gender'];
    $_SESSION['username']=$row['username'];
    $_SESSION['email']=$row['email'];
    $_SESSION['password']=$row['password'];
    $_SESSION['nationality']=$row['nationality'];
    $_SESSION['role']=$row['role'];
    $macaddress=exec('getmac');
    $macaddress=strtok($macaddress," ");
    $_SESSION['macAddress']=$macaddress;
    $ipaddress=getHostByName(gethostname());
    $_SESSION['ipAddress']=$ipaddress;
    function getBrowser() {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "N/A";
        
        $browsers = array(
        '/msie/i' => 'Internet explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/mobile/i' => 'Mobile browser'
        );
        
        foreach ($browsers as $regex => $value) {
        if (preg_match($regex, $user_agent)) { $browser = $value; }
        }
        
        return $browser;
    }
    $browser=getBrowser();
    $_SESSION['browser']=$browser;


    function get_operating_system() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $operating_system = 'Unknown Operating System';
    
        //Get the operating_system name
        if (preg_match('/linux/i', $u_agent)) {
            $operating_system = 'Linux';
        } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
            $operating_system = 'Mac';
        } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
            $operating_system = 'Windows';
        } elseif (preg_match('/ubuntu/i', $u_agent)) {
            $operating_system = 'Ubuntu';
        } elseif (preg_match('/iphone/i', $u_agent)) {
            $operating_system = 'IPhone';
        } elseif (preg_match('/ipod/i', $u_agent)) {
            $operating_system = 'IPod';
        } elseif (preg_match('/ipad/i', $u_agent)) {
            $operating_system = 'IPad';
        } elseif (preg_match('/android/i', $u_agent)) {
            $operating_system = 'Android';
        } elseif (preg_match('/blackberry/i', $u_agent)) {
            $operating_system = 'Blackberry';
        } elseif (preg_match('/webos/i', $u_agent)) {
            $operating_system = 'Mobile';
        }
        
        return $operating_system;
    }
$operatingSystem=get_operating_system();
$_SESSION['operatingSystem']=$operatingSystem;

// save the details
$saveDetails="insert into otherDetails(macAddress,ipAddress,browser,operatingSystem) values
('$macaddress','$ipaddress','$browser','$operatingSystem');";
$sendsavedetails=mysqli_query($connection,$saveDetails);

// if($_SESSION['userId']){
    
// }

    
}

?>