<?php
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();

$_SESSION['badbreweryinput'] = array();

$logger = $dao->__construct();
$conn = $dao->getConnection();

if (strlen('breweryName') == 0) {
    $_SESSION['badbreweryinput'][] = "Enter a brewery name.";
}

if (count($_SESSION['badbreweryinput']) == 0) {
    $dao->addBrewery($_POST['breweryName']);
    header($dao->getHost() . "admin_whatsOnTap.php");
} else {
    header($dao->getHost() . "admin_whatsOnTap.php");
}
?>