<?php $pageName = "AdminlogIn"; ?>
<?php 
    session_start();
    require_once 'index.php'; 
?>

        <div id="logIn">
            <p id="hopImg" style="float: left;"><img style="height: 150px; width: 550px"src="https://media.istockphoto.com/vectors/hop-flourish-vector-id474284281?k=6&m=474284281&s=612x612&w=0&h=lQYXNAnjWTXgConnl-1KLEFntU2TA688E9r2oLfszCY=" border: 1px /></p>
            <form id="logInForm" method="POST" action="adminLogin_handler.php">
                <div>Admin Username:<input id="username" name="username"></div>
                <div>Password:<input type="password" id="password" name="password"></div>
                <div><input type="submit" id="logInButton" value="Log In"></div>
            </form>
            <?php 
                if (isset($_SESSION['badadmin'])) {
                    foreach ($_SESSION['badadmin'] as $error)  {
                        echo "<div class='signUpMessages'>{$error}</div>";
                    }
                }
            ?>
        </div>    
    </div>
</div>

<?php require_once 'footer.php'; ?>