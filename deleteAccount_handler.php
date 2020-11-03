<?php
session_start();

require_once 'Dao.php';

$dao = new Dao();
$_SESSION['deleteuser'] = array();

$logger = $dao->getLogger();

if (strlen('username') == 0) {
    $_SESSION['deleteuser'][] = "Enter a user name.";
}

if (strlen('password') == 0) {
    $_SESSION['deleteuser'][] = "Enter a password.";
}

if (count($_SESSION['deleteuser']) == 0) {
    $logger->LogInfo("deleting user");
    // print("session user : " . $_SESSION['user']);
    // print("session: " . $_SESSION['authenticated']);
    if ($_SESSION['user'] == $_POST['username']) {
        if ($dao->getUser($_POST['username'], $_POST['password'])) {
            //print("deleting user\n");
            $dao->deleteUser($_POST['username']);
            session_unset();
            session_destroy();
            //print("destroy user: " . $_SESSION['user']);
            header($dao->getHost());
            exit();
        }
    }
} else {
    header($dao->getHost() . "deleteUser.php");
    exit();
}