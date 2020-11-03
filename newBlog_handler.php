<?php
session_start();

require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger ("log.txt" , KLogger::DEBUG);
$_SESSION['badblog'] = array();
$_SESSION['blogid'] = " ";

// Validate blog post
if (strlen($_POST['blogTitle']) == 0) {
    $logger->LogInfo("didn't enter a blog title");
    $_SESSION['badblog'][] = "Please enter a title for blog post.";
}

if (strlen($_POST['blogTitle']) > 64) {
    $logger->LogInfo("blog title is too long");
    $_SESSION['badblog'][] = "Blog title is too long.";
}

if (strlen($_POST['blogText']) == 0) {
    $logger->LogInfo("didn't enter a blog post");
    $_SESSION['badblog'][] = "Please enter text for blog post.";
}

if (count($_SESSION['badblog']) == 0) {
    $logger->LogInfo("valid blog post");
    $dao->addBlogPost($_SESSION['user'], $_POST['blogTitle'], $_POST['blogText']);
    header($dao->getHost() . "beerBlog.php");
} else {
    $logger->LogInfo("not a valid blog post");
    header($dao->getHost() . "createNewBlog.php");
}
?>