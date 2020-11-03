<?php  
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger ("log.txt", KLogger::DEBUG);
$dao->getLogger();
$_SESSION['badcomment'] = array();

// Validate comment
if (strlen($_POST['blogComment']) == 0) {
    $logger->LogInfo("didn't enter a blog title");
    $_SESSION['badcomment'][] = "Please enter a blog comment.";
}

if (strlen($_POST['blogComment']) > 255) {
    $logger->LogInfo("blog title is too long");
    $_SESSION['badcomment'][] = "Blog comment is too long.";
}

if (count($_SESSION['badcomment']) == 0) {
    $logger->LogInfo("valid blog comment");
    $dao->addBlogComment(1, 1, $_POST['blogComment']);
    header($dao->getHost() . "beerBlog.php");
} else {
    $logger->LogInfo("not a valid blog comment");
    header($dao->getHost() . "beerBlog.php");
}
?>