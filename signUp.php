<?php $pageName = "signUp"; ?>
<?php 
    session_start();
    require_once 'index.php';
?>
        <div id="signUp">
        <p id="signUpImg" style="float: right;"><img style="height: 275px; width: 275px;" src="https://media.istockphoto.com/vectors/cartoon-hop-mascot-vector-id452096053?k=6&m=452096053&s=612x612&w=0&h=4uX4dgwK9ILD3UCRdOIOZ6O_8KCDJFh5rqhgyuaaqCE=" border: 1px /></p>
            <form id="signUpForm" action="signUp_handler.php" method="POST">
                <div>Username:<input type="text" id="signUpUsername" name="username"></div>
                <div>Password:<input type="password" name="password" id="signUpPassword"></div>
                <div>Confirm Password:<input type="password" name="confirmPass" id="confirmPass"></div>
                <div>Email Address:<input type="email" name="email" id="email"></div>
                <div><input type="submit" id="signUpButton" name="signUpButton" value="Sign Up"></div>
            </form>  
            <?php 
                if (isset($_SESSION['badsignup'])) {
                    foreach ($_SESSION['badsignup'] as $error)  {
                        echo "<div class='signUpMessages'>{$error}</div>";
                    }
                }
            ?> 
        </div>    
    </div>
</div>    
<?php require_once 'footer.php'; ?>