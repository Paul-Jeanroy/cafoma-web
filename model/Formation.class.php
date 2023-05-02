<?php

class Formation implements JsonSerializable {
    private $acronyme; 
    private $titre;
    private $description;
    private $image;
    private $video; 
    private $pourQui;
    private $prerequis;
    private $sequenceList;
    
    
    function __construct($acronyme, $titre, $description, $image, $video, $pourQui, $prerequis) {
        $this->acronyme = $acronyme;
        $this->titre = $titre;
        $this->description = $description;
        $this->image = $image;
        $this->video = $video;
        $this->pourQui = $pourQui;   
        $this->prerequis = $prerequis;
      
    }
    public function jsonSerialize() {
       
        return [
            'acronyme' => $this->acronyme,
            'titre' => $this->titre,
            'image' => $this->image,
            'description' => $this->description,
            'pourQui' => $this->pourQui,
            'video' => $this->video,
            'prerequis' => $this->prerequis,    
        ];
    }
    public function __toString() {
        return $this->acronyme." ".$this->titre." ".$this->image." ". $this->description." ". $this->pourQui." ". $this->video." ". $this->prerequis;
    }
    
    public function ajoutSequence($sequence) {
        $this->sequenceList[] = $sequence;
    }
           
    function getTitre() {
        return $this->titre;
    }
    
    function getAcronyme() {
        return $this->acronyme;
    }

    function getDescription() {
        return $this->description;
    }

    function getImage() {
        return $this->image;
    }

    function getPourQui() {
        return $this->pourQui;
    }
    
    function getVideo() {
        return $this->video;
    }
    
    function getPrerequis() {
        return $this->prerequis;
    }
    
    public function getSequenceList() {
        return $this->sequenceList;
    }

    public function setSequenceList($sequenceList): void {
        $this->sequenceList = $sequenceList;
    }

	
}
