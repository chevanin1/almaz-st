<?php

class Reviews extends CI_Model {

    public function __construct() {
        parent::__construct();
    } // End constructor
    
    
    public function getReviewsOnMain() {
    
        $result = array();
        $result[] = array(
            'text' => "Хорошая компания, все сделали быстро и качественно",
            'author' => "Иванов Иван Иванович",
            'date' => "20.10.2016",
        );        
        $result[] = array(
            'text' => "Лучшее соотношение цена-качество",
            'author' => "Петров Петр Петрович",
            'date' => "20.06.2016",
        );        
        
        return $result;
    
    } // End function getReviewsOnMain

} // End Reviews

?>