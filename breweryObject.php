<?php
require_once 'beerObject.php';

class BreweryObject {

    public $breweryID;
    public $breweryName;
    public $beers = array();

    public function __construct($breweryID, $breweryName) {
        $this->breweryID = $breweryID;
        $this->breweryName = $breweryName;
    }

    public function getBreweryID() {
        return $this->breweryID;
    }

    public function getBreweryName() {
        return $this->breweryName;
    }

    public function addBeer($beer) {
        $this->beers[] = $beer;
    }

    public function getBeers() {
        return $this->beers;
    }

    public function setBeers($beers) {
        $this->beers = $beers;
    }
}
?>