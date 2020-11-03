<?php $pageName = "deleteAccount"; ?>
<?php 
session_start();
require_once 'Dao.php';
$dao = new Dao();
$dao->userAuthentication();
require_once 'index.php';
?>
        <div id="delete">
            <p id="deleteImg" style="float: left;"><img style="height: 185px; width: 275px" src="http://imgc.allpostersimages.com/images/P-473-488-90/74/7476/JX2Q100Z/posters/beer-got-me-into-this-mess-beer-will-get-me-out-funny-indoor-outdoor-plastic-sign.jpg" border: 1px /></p>
            <form id="deleteAccountForm" method="POST" action="deleteAccount_handler.php">
                <div>Username:<input id="deleteUsername" name="username"></div>
                <div>Password:<input type="password" id="deletePassword" name="password"></div>
                <div><input type="submit" id="deleteAccountButton" value="Delete Account"></div>
            </form>
        </div>    
    </div>
</div> 
<?php require_once 'footer.php'; ?>