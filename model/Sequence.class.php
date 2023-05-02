<?php
class Sequence {
    private $acronyme;
    private $intitule;
    private $description;
    private $numero_sequence;
    private $ressourceList; 
    
    function __construct($acronyme,$intitule,$description,$numero_sequence) {
        $this->acronyme= $acronyme;
        $this->intitule= $intitule;
        $this->description= $description;
        $this->numero_sequence= $numero_sequence;
    }
    public function __toString() {
        return $this->intitule."<br>";
    }
    
    function getIntitule() {
        return $this->intitule;
    }
    
    function getAcronyme() {
        return $this->acronyme;
    }
    
    public function getNumSequence() {
        return $this->numero_sequence;
    }
    
    public function getRessourceList() {
        return $this->ressourceList;
    }
    
    public function setRessourceList($ressourceList): void {
        $this->ressourceList = $ressourceList;
    }


    
}