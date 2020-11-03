<?php  
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger ("log.txt", KLogger::DEBUG);
$dao->getLogger();
$_SESSION['badreviewcomment'] = array();

// Validate comment
if (strlen($_POST['reviewComment']) == 0) {
    $logger->LogInfo("didn't enter a review comment");
    $_SESSION['badreviewcomment'][] = "Please enter a review comment.";
}

if (strlen($_POST['reviewComment']) > 255) {
    $logger->LogInfo("review comment is too long");
    $_SESSION['badreviewcomment'][] = "Review comment is too long.";
}

if (count($_SESSION['badreviewcomment']) == 0) {
    $logger->LogInfo("valid review comment");
    $dao->addReviewComment(1, 1, $_POST['reviewComment']);
    header($dao->getHost() . "reviews.php");
} else {
    $logger->LogInfo("not a valid review comment");
    header($dao->getHost() . "reviews.php");
}
?>