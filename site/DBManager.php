<?php

class DBManager {

    const DB_SERVER = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = 'root';   
    const DB_NAME = 'test';

    // const DB_SERVER = 'mysql.mdv.cz8.ru:3306';
    // const DB_USER = 'dbu_mdv_3';
    // const DB_PASSWORD = 'JW98CWy9Hlc';   
    // const DB_NAME = 'db_mdv_9';

    // const DB_SERVER = 'baze.boogiewoogie.ru:64000';
    // const DB_USER = 'jazzbase_boogiewoogie_ru';
    // const DB_PASSWORD = '86artzRp';   
    // const DB_NAME = 'jazzbase_boogiewoogie_ru';


    private static $log = null;
    private static $singers = null;
    
    protected static $_instance;    

    const ALBUM_SELECT = "SELECT alb_id, jb_id, sgr_id, alb_type, alb_name, alb_year, alb_descr FROM albums ";
    const ALBUM_SELECT_LIST = "SELECT alb_id, jb_id, albums.sgr_id, alb_type, alb_name, alb_year, sgr_name as alb_descr FROM albums inner join singers on singers.sgr_id = albums.sgr_id ";
    const SINGER_SELECT = "SELECT sgr_id, sgr_name, sgr_descr FROM singers ";
    const STYLES_SELECT = 'SELECT stl_id, stl_name from styles ';
    const STYLES_COUNT_SELECT = 'SELECT count(*) as c from singer_styles ';
    const SINGER_STYLES_SELECT = "SELECT sst_id, stl_id, sgr_id FROM singer_styles ";
    const INSTRUMENTS_SELECT = 'SELECT ins_id, ins_name from instruments ';
    const INSTRUMENTS_COUNT_SELECT = 'SELECT count(*) as c from singer_instruments ';
    const SINGER_INSTRUMENTS_SELECT = "SELECT ins_id, sin_id, sgr_id FROM singer_instruments ";
    const SINGER_SEEALSO_SELECT = "SELECT sgr_id, seealso_id FROM singers_see_also ";
    
    private function __construct($log = null){
        $this->log = $log;
        $this->connect();
    }
 
    private function __clone(){
    }
    
    public static function getInstance($log = null) {        
        if (null === self::$_instance) {        
            self::$_instance = new self($log);
        }
        
        return self::$_instance;
    }

    private static function log($message) {
        if (self::$log) {
            self::$log->debug($message);
        }
    }


    public function getSingers() {       
        if (null === self::$singers) {                    
                        
            $q = mysql_query(self::SINGER_SELECT);
            self::$singers = $this->parseSingersQuery($q);            
        }
        return self::$singers;    
    }

    public function getSingersBySearch($search) {        
        $q = mysql_query(self::SINGER_SELECT . "WHERE sgr_name LIKE '%$search%'");
        $singers = $this->parseSingersQuery($q);
        return $singers;
    }

    public function getSingersByLetterSearch($search) {        
        $q = mysql_query(self::SINGER_SELECT . "WHERE sgr_name LIKE '$search%'");
        $singers = $this->parseSingersQuery($q);
        return $singers;
    }

    public function getSingersByStyleSearch($style) {
        $st = $this->getStyleByName($style);        
        $styleId = $st->getId();        
        $q = mysql_query(self::SINGER_STYLES_SELECT . "WHERE stl_id = $styleId");
        while ($f = mysql_fetch_assoc($q)) {
            $singerId = $f['sgr_id'];            
            $singers[$singerId] = $this->getSinger($singerId);
        }
        return $singers;
    }

    public function getSingersByInstrumentSearch($instrument) {
        $ins = $this->getInstrumentByName($instrument);        
        $instrumentId = $ins->getId();        
        $q = mysql_query(self::SINGER_INSTRUMENTS_SELECT . "WHERE ins_id = $instrumentId");
        while ($f = mysql_fetch_assoc($q)) {
            $singerId = $f['sgr_id'];            
            $singers[$singerId] = $this->getSinger($singerId);
        }
        return $singers;
    }

    private function parseSingersQuery($q) {
        $singers = array();        
        while ($f = mysql_fetch_assoc($q)) {
            $s = new Singer($f['sgr_id'], $f['sgr_name'], $f['sgr_descr']);
            $singers[$s->getId()] = $s;
        }            
        return $singers;
    }

    public function getSinger($id) {
        $s = self::getSingers();
        return $s[$id];
    }

    public function getAlbumsBySinger($singerId) {        
        $q = mysql_query(self::ALBUM_SELECT . "WHERE sgr_id = $singerId order by alb_year");                
        return $this->parseAlbums($q);
    }

    private function parseAlbum($f) {       
        return new Album($f['alb_id'], $f['jb_id'], $f['sgr_id'], $f['alb_type'], $f['alb_name'], $f['alb_year'], $f['alb_descr']);        
    }

    private function parseAlbums($q) {
        $albums = array();
        while ($f = mysql_fetch_assoc($q)) {        
            $album = $this->parseAlbum($f);
            $albums[$album->getId()] = $album;
        }
        return $albums;
    }

    public function getAlbumsBySearch($search) {
        $q = mysql_query(self::ALBUM_SELECT . "WHERE alb_name LIKE '%$search%'");                
        return $this->parseAlbums($q);
    }

    public function getAlbumById($id) {
        $q = mysql_query(self::ALBUM_SELECT . "where alb_id = $id");
        $f = mysql_fetch_assoc($q);        
        return $this->parseAlbum($f);
    }

    public function getAlbumsByType($type) {        
        $q = mysql_query(self::ALBUM_SELECT_LIST . "WHERE alb_type = $type " . 'order by alb_year desc');        
        return $this->parseAlbums($q);           
    }

    public function getStyles() {
        $q = mysql_query(self::STYLES_SELECT);
        return $this->parseStyles($q);         
    }

    public function getStylesBySingerId($singerId) {
        
        $q = mysql_query(self::SINGER_STYLES_SELECT . "WHERE sgr_id = $singerId");
        while ($f = mysql_fetch_assoc($q)) {
            $styleId = $f['stl_id'];            
            $style = $this->getStyleById($styleId);
            $styles[$style->getId()] = $style;            
        }
        return $styles;
    }

    public function getStyleById($id) {
        $q = mysql_query(self::STYLES_SELECT . "where stl_id = $id");
        $f = mysql_fetch_assoc($q);        
        return $this->parseStyle($f);
    }

    public function getStyleByName($name) {
        $q = mysql_query(self::STYLES_SELECT . "where stl_name = '$name'");
        $f = mysql_fetch_assoc($q);        
        return $this->parseStyle($f);
    }

    private function parseStyles($q) {
        $styles = array();
        while ($f = mysql_fetch_assoc($q)) {                   
            $style = $this->parseStyle($f);            
            $styles[$style->getId()] = $style;
        }        
        return $styles;
    }    

    private function parseStyle($f) {       
        $stl_id = $f['stl_id'];
        $q = mysql_query(self::STYLES_COUNT_SELECT . "where stl_id = $stl_id");
        $ff = mysql_fetch_assoc($q);
        return new Style($stl_id, $f['stl_name'], $ff['c']);
    }

    public function getInstruments() {
        $q = mysql_query(self::INSTRUMENTS_SELECT);
        return $this->parseInstruments($q);         
    }

    public function getInstrumentsBySingerId($singerId) {
        $q = mysql_query(self::SINGER_INSTRUMENTS_SELECT . "WHERE sgr_id = $singerId");
        while ($f = mysql_fetch_assoc($q)) {
            $insId = $f['ins_id'];            
            $instrument = $this->getInstrumentById($insId);
            $instruments[$instrument->getId()] = $instrument;
        }
        return $instruments;
    }

    public function getInstrumentByName($name) {
        $q = mysql_query(self::INSTRUMENTS_SELECT . "where ins_name = '$name'");
        $f = mysql_fetch_assoc($q);        
        return $this->parseInstrument($f);
    }

    public function getInstrumentById($instrumentId) {
        $q = mysql_query(self::INSTRUMENTS_SELECT . "where ins_id = $instrumentId");
        $f = mysql_fetch_assoc($q);        
        return $this->parseInstrument($f);
    }

    private function parseInstruments($q) {
        $instrument = array();
        while ($f = mysql_fetch_assoc($q)) {                   
            $instrument = $this->parseInstrument($f);            
            $instruments[$instrument->getId()] = $instrument;
        }        
        return $instruments;
    }    

    private function parseInstrument($f) {       
        $ins_id = $f['ins_id'];
        $q = mysql_query(self::INSTRUMENTS_COUNT_SELECT . "where ins_id = $ins_id");
        $ff = mysql_fetch_assoc($q);
        return new Style($ins_id, $f['ins_name'], $ff['c']);
    }

    public function getSeeAlso($id) {
        $seealso = array();
        $q = mysql_query(self::SINGER_SEEALSO_SELECT . "where sgr_id = $id");
        while ($f = mysql_fetch_assoc($q)) {
            $sid = $f['seealso_id'];            
            $seealso[$sid] = $this->getSinger($sid);
        }        
        return $seealso;
    }

    private function connect() {        
        $c = mysql_pconnect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD);
        
        if ($c) {
            mysql_select_db(self::DB_NAME);
        }

        return $c;
    }
}