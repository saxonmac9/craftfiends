<?php
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();

$_SESSION['badbeerinput'] = array();

$logger = $dao->__construct();
$conn = $dao->getConnection();

if (strlen('beerName') == 0) {
    $_SESSION['badbeerinput'][] = "Enter a beer name.";
}

if (strlen('abv') == 0) {
    $_SESSION['badbeerinput'][] = "Enter an abv.";
}

if (count($_SESSION['badbeerinput']) == 0) {
    $dao->addBeer(1, $_POST['beerName'], $_POST['abv']);
    header($dao->getHost() . "admin_whatsOnTap.php");
} else {
    header($dao->getHost() . "admin_whatsOnTap.php");
}
?>