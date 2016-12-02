<?php

class Banners extends CI_Model {

    public function __construct() {
        parent::__construct();
    } // End constructor
    
    
    public function getBannersOnMain() {
    
        $result = array();
        
        $result[] = array(
            'link' => "#",
            'name' => "Акция 1",
            'img' => "/img/gallery/actions/1.jpg",
            'caption' => "Акция 1",
        );
        $result[] = array(
            'link' => "#",
            'name' => "Акция 2",
            'img' => "/img/gallery/actions/2.jpg",
            'caption' => "Акция 2",
        );
        $result[] = array(
            'link' => "#",
            'name' => "Акция 3",
            'img' => "/img/gallery/actions/3.jpg",
            'caption' => "Акция 3",
        );
        
        return $result;
    
    } // End function getBannersOnMain

} // End Banners

?>