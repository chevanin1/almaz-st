<?php

class Gallery extends CI_Model {

    public function __construct() {
        parent::__construct();
    } // End constructor
    
    
    public function getGalleryOnMain() {
    
        $result = array();
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 1",
            'caption' => "Дом из какого-то бруса 1",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 2",
            'caption' => "Дом из какого-то бруса 2",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 3",
            'caption' => "Дом из какого-то бруса 3",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 4",
            'caption' => "Дом из какого-то бруса 4",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 5",
            'caption' => "Дом из какого-то бруса 5",
            'link' => "#",
        );        
                
        return $result;
    
    } // End function getGalleryOnMain
    
    
    public function getGalleryByCat( $CategoryId ) {
    
        // limit 4
    
        $result = array();
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 1",
            'caption' => "Дом из какого-то бруса 1",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 2",
            'caption' => "Дом из какого-то бруса 2",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 3",
            'caption' => "Дом из какого-то бруса 3",
            'link' => "#",
        );        
        $result[] = array(
            'img' => "http://lorempixel.com/300/300/",
            'name' => "Дом из какого-то бруса 4",
            'caption' => "Дом из какого-то бруса 4",
            'link' => "#",
        );        
      
                
        return $result;
    
    } // End function getGalleryByCat

} // End Gallery

?>