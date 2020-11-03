<?php
session_start();

require_once 'Dao.php';

$dao = new Dao();

$_SESSION['authenticated'] = array();
$_SESSION['badlogin'] = array();
$_SESSION['user'] = " ";
$logger = $dao->getLogger();
$username = $_POST['username'];
$password = $_POST['password'];

if ($dao->getUser($username, $password)) {
    //print("got user");
    $logger->LogInfo("user authenticated on login");
    $_SESSION['authenticated'][] = true;
    $_SESSION['user'] = $username;
    header($dao->getHost() . "craftFiends.php");
} else {
    //print("didn't get user");
    $_SESSION['authenticated'][] = false;
    $_SESSION['badlogin'][] = "Invalid login. Please try again.";
    header($dao->getHost() . "logIn.php");
    exit();
}