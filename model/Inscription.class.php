<?php
class Inscription {
    private $formation;
    private $dateInscription;
    
    function __construct($formation, $dateInscription) {
        $this->formation= $formation;
        $this->dateInscription = $dateInscription;
    }
    public function __toString() {
        return $this->acronyme." ".$this->dateInscription." ".$this->titre."<br>";
    }
    
    function getFormation() {
        return $this->formation;
    }
    function getDateInscription() {
        return $this->dateInscription;
    }



    
}
