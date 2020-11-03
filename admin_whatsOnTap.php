<?php $pageName = "admin_whatsOnTap"; ?>
<?php 
  session_start();
  if ((isset($_SESSION['adminAuthenticated']) && !$_SESSION['adminAuthenticated']) || !isset($_SESSION['adminAuthenticated'])) {
    header("Location: http://localhost/logIn.php");
  }
  
  require_once 'index.php'; 
?>
          <p id="tapThatImg" style="float: right;"><img style="height: 500px; width: 324" src="https://i.pinimg.com/736x/2b/ea/b6/2beab66c601a82a960429f446815b85f.jpg" border: 1px /></p>
          <div id="onTapBox" style="height: 500px; width: 70%; overflow: auto;">
            <p>
              Check out what's on tap around town and see which 
              pub is carrying your favorite beers. Or maybe you're 
              wanting to find something or someplace new? You can 
              find it all right here. Cheers!
            </p>
            <?php
              require_once 'Dao.php';
              $dao = new Dao();

              foreach ($dao->getAllBreweries() as $brewery) {
                  echo "<p>$brewery->breweryName</p>";
                  foreach ($brewery->getBeers() as $beers) {
                    echo "<p style='margin-left: 50px;'>$beers->beerName</p>";
                }
              }
            ?>
            <form id="adminWOTform" action="whatsOnTap_breweryHandler.php" method="POST">
              <div>Brewery Name:<input type="text" id="breweryName" name="breweryName"></div>
              <div><input type="submit" id="addBreweryButton" value="Add Brewery"></div>
            </form>
            <form id="adminWOTform" action="whatsOnTap_beerHandler.php" method="POST">
              <div>Beer Name:<input type="text" id="beerName" name="beerName"></div>
              <div>ABV:<input type="text" id="abv" name="abv"></div>
              <div><input type="submit" id="addBeerButton" value="Add Beer"></div>
            </form>    
          </div>  
        </div>  
      </div>

<?php require_once 'footer.php'; ?>