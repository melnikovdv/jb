<?php

class Singer {

    protected $id;    
    protected $name;
    protected $descr;    

    public function __construct($id, $name, $descr) {
        $this->id = $id;
        $this->name = $name;
        $this->descr = $descr;        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function getLink($pathToSinger = './') {
        return $pathToSinger . 'singers/' . $this->getId();
    }

    public function getImgLink() {
        return '../images/' . $this->getId() . '.jpg';
    }
}

class Album {

    protected $id;
    protected $jbId;
    protected $singerId;
    protected $type;
    protected $name;
    protected $year;
    protected $descr;

    public function __construct($id, $jbId, $singerId, $type, $name, $year, $descr) {
        $this->id = $id;
        $this->jbId = $jbId;
        $this->singerId = $singerId;
        $this->type = $type;
        $this->name = $name;
        $this->year = $year;
        $this->descr = $descr;        
    }

    public function getId() {
        return $this->id;
    }

    public function getJbId() {
        return $this->jbId;
    }

    public function getType() {
        return $this->type;
    }

    public function getName() {
        return $this->name;
    }

    public function getYear() {
        return $this->year;
    }

    public function getDescr() {
        return $this->descr;
    }

    public function getLink($pathToAlbum) {
        return './' . $pathToAlbum . $this->singerId . '/' . $this->getId();
    }

    public function getImgLink() {
        return '../../images/' . $this->singerId . '_' . $this->getJbId() . '.jpg';
    }

    public function isDvd() {
        if ($this->type == 1) 
            return true;
        else
            return false;
    }    
}

class Style {

    protected $id;
    protected $name;
    protected $count;    

    public function __construct($id, $name, $count) {
        $this->id = $id;
        $this->name = $name;
        $this->count = $count;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCount() {
        return $this->count;
    }

}