<?php 
class reviewObject implements JsonSerializable {

    public $reviewId;
    public $title;
    public $beer;
    public $location;
    public $review;

    public function __construct($reviewId, $title, $beer, $location, $review) {
        $this->reviewId = $reviewId;
        $this->title = $title;
        $this->beer = $beer;
        $this->location = $location;
        $this->review = $review;
    }

    public function jsonSerialize() {
        return array(
            'id'=>$this->reviewId,
            'title'=>$this->title, 
            'beer'=>$this->beer,
            'location'=>$this->location,
            'review'=>$this->review
        );
    }

    public function __toString() {
        return $this->title;
    }
}

?>