<?php $pageName = "reviews"; ?>
<?php
session_start(); 
require_once 'index.php'; 
?>
        <script src="reviews.js"></script>
        <div>
            <div id="reviewContent">
            <p id="reviewsImg"><img class="reviewsImg" src="https://i.pinimg.com/736x/21/ff/82/21ff82269fede762dd4cf43212bfbab9.jpg" border: 1px /></p>
                <div id="reviewBox" style="height: 550px; width: 65%; overflow: auto;">
                    <?php
                        require_once 'Dao.php';
                        require_once 'reviewObject.php';
                        $dao = new Dao();
                        $results = $dao->getAllReviewPosts();
                    
                        foreach ($results as $review) {
                            echo "<div id='$review->reviewId' class='reviewContainer'>
                                    <h3>$review->title;  $review->beer;  $review->location</h3>
                                    <div class='buttonContainer'>
                                        <div><input type='button' class='showReviewButton' value='Show Review'></div>
                                        <div><input type='button' class='showCommentsButton' value='Show Comments'></div>
                                    </div>
                                    <div style='display:none' class='showReview'><p>$review->review</p></div>
                                    <div style='display:none' class='showComments'></div>
                                </div>";
                        }
                    ?>
                </div>
            </div>
            <div id="commentContainer" style="display:none">
                <form id="commentForm">
                    <div><label id="comments">Comment:</label></div>
                    <div><textarea id="reviewComments" name="reviewComment"></textarea></div>
                    <div><input type="submit" id="submitComment" value="Add Comment"></div>
                </form>
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