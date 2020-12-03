<?php  
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger ("log.txt", KLogger::DEBUG);
$dao->getLogger();
$_SESSION['badreviewcomment'] = array();

$reviewId = $_POST['reviewId'];
$comment = $_POST['reviewComment'];
echo json_encode($dao->addReviewComment(1, $reviewId, $comment));
//print("comment: " . $comment);
// Validate comment
// if (strlen($comment) == 0) {
//     $logger->LogInfo("didn't enter a review comment");
//     $_SESSION['badreviewcomment'][] = "Please enter a review comment.";
// }

// if (strlen($comment) > 255) {
//     $logger->LogInfo("review comment is too long");
//     $_SESSION['badreviewcomment'][] = "Review comment is too long.";
// }

// if (count($_SESSION['badreviewcomment']) == 0) {
//     $logger->LogInfo("valid review comment");
//     echo json_encode($dao->addReviewComment($_SESSION['user'], $reviewId, $comment));
//     //header($dao->getHost() . "reviews.php");
// } else {
//     //print("bad comment\n");
//     $logger->LogInfo("not a valid review comment");
//     //header($dao->getHost() . "reviews.php");
// }
?>