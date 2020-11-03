<?php $pageName = "reviews"; ?>
<?php
session_start(); 
require_once 'index.php'; 
?>

        <div>
        <p id="reviewsImg" style="float: right;"><img style="height: 510px; width: 385px;" src="https://i.pinimg.com/736x/21/ff/82/21ff82269fede762dd4cf43212bfbab9.jpg" border: 1px /></p>
            <div id="reviewBox" style="height: 400px; width: 65%; overflow: auto;">
            <?php
                    require_once 'Dao.php';
                    $dao = new Dao();

                    foreach ($dao->getAllReviewPosts() as $results) {
                        echo "<p>$results[review]</p>";
                    }

                    foreach ($dao->getAllReviewComments() as $comments) {
                        echo "<p>$comments[comment]</p>";
                    }
                ?>
                <p>
                    To make this area function and display the way I intend will require
                    javascript. But for now it should at least display the text of the blog
                    post in p tags and it should also display comments. Basically, the 
                    interaction with the database should be functional.
                </p>
            </div>
            <div>
                <form id="commentForm" method="POST" action="reviewComments_handler.php">
                    <div><label id="comments">Comment:</label></div>
                    <div><textarea id="reviewComments" name="reviewComment">Also, the comments functionality is not available at this point. It will require JavaScript in order to be able to function properly.</textarea></div>
                    <div><input type="submit" id="submitComment" value=" Add Comment"></div>
            </div>
            <?php 
                if (isset($_SESSION['badreviewcomment'])) {
                    foreach ($_SESSION['badreviewcomment'] as $error)  {
                        echo "<div class='signUpMessages'>{$error}</div>";
                    }
                }
            ?> 
        </div>
    </div>  
</div>         
<?php require_once("footer.php"); ?>