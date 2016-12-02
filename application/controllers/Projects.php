<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {


    public function __construct() {
        parent::__construct();
         
        $this->load->model('commondata'); 
         
         
    } // End constructor

	public function index() {
        
        /*
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
        */
                
	} // End index

    /*
	public function categories() {
    
        //$this->load->model('banners');
        $this->load->model('catalog');
        //$this->load->model('reviews');
        //$this->load->model('gallery');
                
        $commondata = $this->commondata->getAllHeaderDatas();               
		$this->load->view('main/header', $commondata);
                
        $data = array();
        //$data['banners_data']['items'] = $this->banners->getBannersOnMain();
        //$data['bestsellers']['items'] = $this->catalog->getBestsellers();
        //$data['reviews']['items'] = $this->reviews->getReviewsOnMain();
        //$data['examples']['items'] = $this->gallery->getGalleryOnMain();
        
		$this->load->view('catalog/category', $data);
		$this->load->view('main/footer');
                
	} // End index
    */
    
} // End class Main
