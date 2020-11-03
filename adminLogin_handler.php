<?php  
session_start();
require_once 'Dao.php';

$dao = new Dao();
$dao->getLogger();
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['adminAuthenticated'] = array();
$_SESSION['badadmin'] = array();

if ($username == 0 || $username > 64) {
    $_SESSION['badadmin'][] = "Please enter a valid admin login username.";
}

if ($password == 0 || $password > 64) {
    $_SESSION['badadmin'][] = "Please enter a valid admin login password.";
}

print("username: " . $username . "; password: " . $password);

if ($dao->getAdmin($username, $password)) {
    $_SESSION['adminAuthenticated'] = true;
    header($dao->getHost() . "admin_whatsOnTap.php");  
} else {
    $_SESSION['adminAuthenticated'] = false;
    header($dao->getHost() . "adminLogin.php");
    exit();
}
?>