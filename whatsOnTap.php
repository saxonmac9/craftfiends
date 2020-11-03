<?php $pageName = "whatsOnTap"; ?>
<?php 
session_start();
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
            <p>
              To really get this page to display the way I want will require javascript,
              but for now it should at least be able to interact with the db and display
              a crude unfinished list.
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
          </div>  
        </div>  
      </div>

<?php require_once 'footer.php'; ?>
