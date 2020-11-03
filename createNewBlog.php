<?php $pageName = "createNewBlog"; ?>
<?php  
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $dao->userAuthentication();
    require_once 'index.php';
?>
            <div id="newBlog">
                <p id="createCraftImg" style="float: left;"><img style="height: 350px; width: 475px" alt="logo" src="http://i.huffpost.com/gen/1966437/images/o-CRAFT-BEERS-facebook.jpg" border: 1px /></p>
                <form id="createBlogForm" method="POST" action="newBlog_handler.php">
                    <div>Title:<input type="text" id=blogTitle name="blogTitle"></div>
                    <div><textarea id="blogText" name="blogText"></textarea></div>
                    <div><input type="submit" id="addBlogButton" value="Add Blog Post"></div>
                </form>
                <?php 
                    if (isset($_SESSION['badblog'])) {
                        foreach ($_SESSION['badblog'] as $error)  {
                            echo "<div class='signUpMessages'>{$error}</div>";
                        }
                    }
                ?>
            </div> 
        </div>
    </div> 
<?php require_once 'footer.php'; ?>