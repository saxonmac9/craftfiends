<?php $pageName = "beerBlog"; ?>
<?php 
session_start();
require_once 'index.php'; 
?>

        <div>
            <p id="blogImg" style="float: right;"><img style="height:500px; width: 375px" src="http://hoppinessdelivered.com/wp-content/uploads/2017/03/comic.jpg" border: 1px /></p>
            <div id="reviewBox" style="height: 400px; width: 65%; overflow: auto;">
                <?php
                    require_once 'Dao.php';
                    $dao = new Dao();

                    foreach ($dao->getAllBlogPosts() as $results) {
                        echo "<p>$results[post]</p>";
                    }

                    foreach ($dao->getAllBlogComments() as $comments) {
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
                <form id="commentForm" method="POST" action="beerBlog_handler.php">
                    <div><label id="comments">Comment:</label></div>
                    <div><textarea id="reviewComments" name="blogComment"></textarea></div>
                    <div><input type="submit" id="submitComment" value="Add Comment"></div>
                </form>
                <?php 
                if (isset($_SESSION['badcomment'])) {
                    foreach ($_SESSION['badcomment'] as $error)  {
                        echo "<div class='signUpMessages'>{$error}</div>";
                    }
                }
            ?> 
            </div> 
        </div>
    </div>
</div>  
    
<?php require_once 'footer.php'; ?>