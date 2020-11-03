<?php  
  session_start();
?>
<html>
  <head> 
    <title>Craft Fiends</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="craftFiends.css">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Handlee&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="top">
      <p style="float: left;"><img style="height:225px;" alt="logo" src="https://clipartix.com/wp-content/uploads/2016/04/Beer-images-free-beer-pictures-download-clip-art.png" border: 1px /></p>
      <p style="float: right;"><img style="height:225px;" src="https://images.fineartamerica.com/images-medium-large-5/bartender-pouring-drinking-keg-barrel-beer-retro-aloysius-patrimonio.jpg" border: 1px /></p>
      <h1>Craft Fiends</h1>
      <h2>A website for people with beer on their mind!</h2>
    </div>
    <hr></hr>
    <div id="middle">
      <div id="navigation">
        <ol>
          <li><a <?php if ($pageName == "homepage") { echo "class='active';"; } ?> href="craftFiends.php" style="text-decoration: none;">Homepage</a></li>
          <li><a <?php if ($pageName == "whatsOnTap") { echo "class='active';"; } ?> href="whatsOnTap.php" style="text-decoration: none;">What's on Tap</a></li>
          <li><a <?php if ($pageName == "reviews") { echo "class='active';"; } ?> href="reviews.php" style="text-decoration: none;">Reviews</a></li>
          <li><a <?php if ($pageName == "addReview") { echo "class='active';"; } ?> href="addReview.php" style="text-decoration: none;">Add Review</a></li>            
          <li><a <?php if ($pageName == "beerBlog") { echo "class='active';"; } ?> href="beerBlog.php" style="text-decoration: none;">Beer Blog </a></li>
          <li><a <?php if ($pageName == "createNewBlog") { echo "class='active';"; } ?> href="createNewBlog.php" style="text-decoration: none;">Create/Add New Blog</a></li>
          <li><a <?php if ($pageName == "logIn") { echo "class='active';"; } ?> href="logIn.php" style="text-decoration: none;">Log In</a></li>
          <li><a <?php if ($pageName == "signUp") { echo "class='active';"; } ?> href="signUp.php" style="text-decoration: none;">Sign Up</a></li>
        </ol>
      </div>
      <div id="content">  
    

 
 

