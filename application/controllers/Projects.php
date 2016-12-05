<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {


    public function __construct() {
        parent::__construct();
         
        $this->load->model('commondata'); 
        $this->load->model('catalog');         
         
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


	public function categories() {

        if( $this->uri->segment(3) ) {
            
            //$this->load->model('banners');
            $this->load->model('gallery');  

            $this->load->helper('text');
                
            $CategoryID = $this->uri->segment(3);
            $Category = $this->catalog->GetCategory(intval($CategoryID));
            
            if( count( $Category ) > 0 ) {
            
                $SubCategories = $this->catalog->GetCategories( array( 'parent_id' => $CategoryID) );
                foreach( $SubCategories as $key => $value ) {                
                    $SubCategories[$key]['description'] = character_limiter($SubCategories[$key]['description'], 100);
                } // End foreach
                
                $AllCategoryIds = array();
                $AllCategoryIds[] = $CategoryID;
                foreach( $SubCategories as $item ) {
                    $AllCategoryIds[] = $item['id'];
                } // End foreach                
                
                $ItemsOnPage = 20;
                $Items = $this->catalog->GetItems(array( 'category_id' => $AllCategoryIds ), $ItemsOnPage);                
                foreach( $Items as $key => $value ) {                
                    $Items[$key]['description'] = character_limiter($Items[$key]['description'], 100);
                    if( isset( $Items[$key]['images'] ) ) {
                        foreach( $Items[$key]['images'] as $image ) {
                            if( $image['num'] == 1 ) {
                                $Items[$key]['img'] = $image['name'];
                            } // End if
                        } // End foreach
                        unset($Items[$key]['images']);
                    } // End if
                } // End foreach
                        
                $commondata = $this->commondata->getAllHeaderDatas();               
                $this->load->view('main/header', $commondata);
                        
                $data = array();
                
                $data['data_cat_img_path'] = base_url();
                $data['data_cat_img_path'] .= '/img/projects/categories/';
                
                $data['data_item_img_path'] = base_url();
                $data['data_item_img_path'] .= '/img/items/';
                
                $data['category_title'] = $Category['name'];
                $data['category'] = $Category;
                $data['sub_categories'] = $SubCategories;
                $data['items'] = $Items;                
                $data['examples'] = $this->gallery->getGalleryByCat($CategoryID);
                
                $this->load->view('catalog/category', $data);
                $this->load->view('main/footer');   
                    
            } else {
                redirect(base_url(), "refresh");
            } // End if
                
        } else {
            redirect(base_url(), "refresh");
        } // End if

                
	} // End index
    
} // End class Main
