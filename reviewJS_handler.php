<?php  
session_start();
require_once 'Dao.php';

$dao = new Dao();

//print("in comments handler");
//echo json_encode(["message" => "success"]);
if (isset($_GET['getReviewComments'])) {
    //print("get review comments post");
    $reviewId = $_GET['reviewId'];
    echo json_encode($dao->getComments($reviewId));
}

?>