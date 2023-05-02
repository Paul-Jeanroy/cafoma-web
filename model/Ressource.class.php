<?php
class Ressource {
    private $intitule;
    private $document;
    private $type_document;
    private $numero_ressource;
    
    function __construct($intitule,$numero_ressource,$type_document,$document) {
        $this->intitule= $intitule;
        $this->numero_ressource = $numero_ressource;
        $this->type_document= $type_document;
        $this->document = $document;
    }
    public function __toString() {
        return $this->intitule." ".$this->document."<br>";
    }
    
    function getIntitule() {
        return $this->intitule;
    }
    function getDocument() {
        return $this->document;
    }
    function getAcronyme() {
        return $this->acronyme;
    }
    function getNumRessource() {
        return $this->numero_ressource;
    }
    function getType() {
        return $this->type_document;
    }
    
}