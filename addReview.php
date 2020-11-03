<?php $pageName = "addReview"; ?>
<?php 
session_start();
require_once 'Dao.php';
$dao = new Dao();
$dao->userAuthentication();
require_once 'index.php'; 
?>
        <div id="addReview">
        <p id="reviewCraftImg" style="float: right;"><img style="height: 300px; width: 425px;" src="https://www.nutritionadvance.com/wp-content/uploads/2019/02/Is-Beer-Good-or-Bad-For-You.jpg" border: 1px/></p>
            <form id="addReviewForm" method="POST" action="addReview_handler.php">
                <div>Title:<input id="reviewTitle" name="reviewTitle"></div>
                <div>Beer and Brewer:<input id="beerName" name="beerName"></div>
                <div>Where Were You:<input id="reviewLocation" name="reviewLocation"></div>
                <div><textarea id="review" name="review"></textarea></div>
                <div><input type="submit" id="addReviewButton" value="Add Review"></div>
            </form>
            <?php 
                if (isset($_SESSION['badreview'])) {
                    foreach ($_SESSION['badreview'] as $error)  {
                        echo "<div class='signUpMessages'>{$error}</div>";
                    }
                }
            ?>
        </div>    
    </div>
</div>    
<?php require_once 'footer.php'; ?>