<?php

class BeerObject {

    public $beerID;
    public $breweryID;
    public $beerName;
    public $percentAlcohol;

    public function __construct($beerID, $breweryID, $beerName, $percentAlcohol) {
        $this->beerID = $beerID;
        $this->breweryID = $breweryID;
        $this->beerName = $beerName;
        $this->percentAlcohol = $percentAlcohol;
    }

    public function getBeerID() {
        return $this->beerID;
    }

    public function getBreweryID() {
        return $this->breweryID;
    }

    public function getBeerName() {
        return $this->beerName;
    }

    public function getPercentAlcohol() {
        return $this->percentAlcohol;
    }
}
?>