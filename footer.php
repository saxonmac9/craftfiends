<?php session_start(); ?>
    </div>  
    <hr></hr>
    <div id="footer">
      <f1>©2020 Craft Fiends</f1>
      <li><a <?php if ($pageName == "contactUs") { echo "class='active';"; } ?> href="contactUs.php" style="text-decoration: none;">Contact Us</a></li>
      <li><a <?php if ($pageName == "deleteAccount") { echo "class='active';"; } ?> href="deleteAccount.php" style="text-decoration: none;">Delete Account</a></li>
      <li><a href="logout.php" style="text-decoration: none">Logout</a></li>
    </div>  
  </body>
</html>