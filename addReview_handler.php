<?php
session_start();

require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();

$logger = new KLogger ("log.txt" , KLogger::DEBUG);
$_SESSION['badreview'] = array();

// Validate review
if (strlen($_POST['reviewTitle']) == 0) {
    $logger->LogInfo("didn't enter a review title");
    $_SESSION['badreview'][] = "Please enter a title for review.";
}

if (strlen($_POST['reviewTitle']) > 64) {
    $logger->LogInfo("review title is too long");
    $_SESSION['badreview'][] = "Review title is too long.";
}

if (strlen($_POST['beerName']) == 0) {
    $logger->LogInfo("didn't enter a beer name");
    $_SESSION['badreview'][] = "Please enter a beer name.";
}

if (strlen($_POST['beerName']) > 64) {
    $logger->LogInfo("beer name is too long");
    $_SESSION['badreview'][] = "Beer name is too long.";
}

if (strlen($_POST['reviewLocation']) == 0) {
    $logger->LogInfo("didn't enter a review location");
    $_SESSION['badreview'][] = "Please enter a location for review.";
}

if (strlen($_POST['reviewLocation']) > 64) {
    $logger->LogInfo("review location is too long");
    $_SESSION['badreview'][] = "Review location is too long.";
}

if (strlen($_POST['review']) == 0) {
    $logger->LogInfo("didn't enter a review");
    $_SESSION['badreview'][] = "Please enter text for a review.";
}

if (count($_SESSION['badreview']) == 0) {
    $logger->LogInfo("valid review post");
    $dao->addReviewPost($_SESSION['user'], $_POST['reviewTitle'], $_POST['beerName'], $_POST['reviewLocation'], $_POST['review']);
    header($dao->getHost() . "reviews.php");
} else {
    $logger->LogInfo("not a valid review post");
    header($dao->getHost() . "addReview.php");
}
?>

