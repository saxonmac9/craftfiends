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
$user = $dao->getUser($username, $password);

if ($user != null) {
    $logger->LogInfo("user authenticated on login");
    $_SESSION['authenticated'][] = true;
    $_SESSION['user'] = $user['userid'];
    header($dao->getHost() . "craftFiends.php");
} else {
    $_SESSION['authenticated'][] = false;
    $_SESSION['badlogin'][] = "Invalid login. Please try again.";
    header($dao->getHost() . "logIn.php");
    exit();
}