<?php
session_start();

require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger ("log.txt" , KLogger::DEBUG);
$_SESSION['good'] = array();
$_SESSION['badsignup'] = array();

//$logger = $dao->getLogger();

// Validation
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPass = $_POST['confirmPass'];
$email = $_POST['email'];

// Checks if username is available
if ($dao->validateUsername($username) != true) {
    $logger->LogInfo("username is not available");
    $_SESSION['badsignup'][] = "Username is already in use. Please select another one.";
}

//Validate username
if (preg_match("#^.[A-Za-z0-9]{4,20}$#", $username)) {
    $logger->LogInfo("valid username entered");
    $_SESSION['good'][] = "You have entered a valid username.";
} else {
    $logger->LogDebug("invalid username");
    $_SESSION['badsignup'][] = "Username must contain at least 4 characters long and contain letters and numbers.";
}

// Validate password
//if (preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
if (preg_match("#^.[A-Za-z0-9]{6,20}$#", $password)) {
    $logger->LogInfo("valid password entered");
    $_SESSION['good'][] = "Your password is valid.";
} else {
    $logger->LogInfo("invalid password");
    $_SESSION['badsignup'][] = "Your password must be at least 4 characters long and be a combination of letters and numbers.";
}

// Confirm password
if ($confirmPass === $password) {
    $logger->LogInfo("passwords matched and confirmed");
    $_SESSION['good'][] = "Passwords match.";
} else {
    $logger->LogInfo("passwords did not match");
    $_SESSION['badsignup'][] = "Please make sure passwords match.";
}

// Validate email address
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $logger->LogInfo("valid email entered");
    $_SESSION['good'][] = "Email address is valid.";
} else {
    $logger->LogInfo("invalid email");
    $_SESSION['badsignup'][] = "Please enter a valid email address.";
}

if (count($_SESSION['badsignup']) > 0) {
    header($dao->getHost() . "signUp.php");
    exit();
} 

if (count($_SESSION['good']) == 4) {
    $logger->LogInfo("new user sign up validated\n");
    if ($dao->createNewUser($username, $password, $email)) {
        $_SESSION['user'] = $username;
        header($dao->getHost() . "craftFiends.php");
        exit();
    }    
}
?>