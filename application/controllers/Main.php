<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


    public function __construct() {
        parent::__construct();
         
        $this->load->model('commondata'); 
         
         
    } // End constructor

	public function index() {
    
        $this->load->model('banners');
        $this->load->model('catalog');
        $this->load->model('reviews');
        $this->load->model('gallery');
                
        $commondata = $this->commondata->getAllHeaderDatas();               
		$this->load->view('main/header', $commondata);
                
        $data['banners_data']['items'] = $this->banners->getBannersOnMain();
        $data['bestsellers']['items'] = $this->catalog->getBestsellers();
        $data['reviews']['items'] = $this->reviews->getReviewsOnMain();
        $data['examples']['items'] = $this->gallery->getGalleryOnMain();
        
		$this->load->view('main/index', $data);
        $this->load->view('main/footer');
                
	} // End index

	public function error() {
    
        $this->load->model('banners');
        $this->load->model('catalog');
        $this->load->model('reviews');
        $this->load->model('gallery');
                
        $commondata = $this->commondata->getAllHeaderDatas();               
		$this->load->view('main/header', $commondata);
                
        $data['banners_data']['items'] = $this->banners->getBannersOnMain();
        $data['bestsellers']['items'] = $this->catalog->getBestsellers();
        $data['reviews']['items'] = $this->reviews->getReviewsOnMain();
        $data['examples']['items'] = $this->gallery->getGalleryOnMain();
        
		$this->load->view('main/error', $data);
		$this->load->view('main/footer');
                
	} // End error
    
    
    public function content_page() {
            
        if( $this->uri->rsegment(3) ) {
        
            $PageID = $this->uri->rsegment(3);
            $Page = $this->commondata->getContentPage(intval($PageID));
            
            if( count( $Page ) > 0 ) {
            
                $commondata = $this->commondata->getAllHeaderDatas();     
              
                $this->load->view('main/header', $commondata);
                        
                $data = array();
                $data['page'] = $Page;
                
                $this->load->view('main/content_page', $data);
                $this->load->view('main/footer');   
                    
            
            } else {
                redirect(base_url(), "refresh");
            } // End if          
                
        } else {
            redirect(base_url(), "refresh");
        } // End if
                
    } // End content_page
    
    
} // End class Main
