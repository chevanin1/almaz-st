<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examples extends CI_Controller {


    public function __construct() {
        parent::__construct();
         
        $this->load->model('commondata'); 
        //$this->load->model('catalog');  
        $this->load->model('gallery');
         
    } // End constructor

    
	public function index() {

        $this->load->helper('text');
        $this->load->model('catalog');
                
        $filter = array();
        $Examples = $this->gallery->GetItems($filter);
        
        $ExamplesByCats = array();
        $ExamplesWithoutCats = array();                   
        $ItemIDs = array();
        $CategoryIDs = array();
        foreach( $Examples as $key => $value ) {           
            if( isset( $Examples[$key]['images'] ) ) {
                foreach( $Examples[$key]['images'] as $image ) {
                    if( $image['num'] == 1 ) {
                        $Examples[$key]['img'] = $image['img'];
                    } // End if
                } // End foreach
                unset($Examples[$key]['images']);
            } // End if    

            if( isset( $value['category_id'] ) && ( $value['category_id'] != 0 ) ) {
                $CategoryIDs[] = $value['category_id'];
                $ExamplesByCats[$value['category_id']][] = $Examples[$key];
            } else {
                $ExamplesWithoutCats[] = $Examples[$key];
            } // End if

            if( isset( $value['item_id'] ) && ( $value['item_id'] != 0 ) ) {
                $ItemIDs[] = $value['item_id'];
            } // End if
            
        } // End foreach  

        $ExamplesByCats[0] = $ExamplesWithoutCats;
        
        if( count( $CategoryIDs ) > 0 ) {
            $filter = array( 'id' => $CategoryIDs );
            $Categories = $this->catalog->GetCategories($filter);
        } else {
            $Categories = array();
        } // End if
        $Categories[] = array( 'id' => 0, 'name' => "Другие примеры работ" );
                    
        if( count( $ItemIDs ) > 0 ) {
            $filter = array( 'id' => $ItemIDs );
            $Projects = $this->catalog->GetItems($filter);
        } else {
            $Projects = array();
        } // End if
                
        $commondata = $this->commondata->getAllHeaderDatas();               
        $this->load->view('main/header', $commondata);
                
        $data = array();
        
        $data['title'] = "Примеры наших работ";
        $data['data_projects_img_path'] = base_url();
        $data['data_projects_img_path'] .= '/img/gallery/';
        
        $data['examples'] = $ExamplesByCats;
        $data['categories'] = $Categories;
        $data['projects'] = $Projects;
                               
        $this->load->view('examples/list', $data);
        $this->load->view('main/footer');   
                
	} // End index
    

	public function item() {
            
        if( $this->uri->segment(3) ) {
            
            $this->load->model('catalog');  
            $this->load->helper('text');
                
            $ExampleID = $this->uri->segment(3);
            $Example = $this->gallery->GetItem(intval($ExampleID));
            
            if( count( $Example ) > 0 ) {
            
                $commondata = $this->commondata->getAllHeaderDatas();               
                $this->load->view('main/header', $commondata);
                        
                $data = array();
                
                if( isset( $Example['category_id'] ) && ( $Example['category_id'] != 0 ) ) {
                    $Category = $this->catalog->GetCategory($Example['category_id']);
                    
                    if( is_array( $Category ) && ( count( $Category ) > 0 ) ) {
                        $Example['category_name'] = $Category['name'];
                    } // End if
                    
                } // End if   
                
                if( isset( $Example['item_id'] ) && ( $Example['item_id'] != 0 ) ) {
                    $Item = $this->catalog->GetItem($Example['item_id']);
                    
                    if( is_array( $Item ) && ( count( $Item ) > 0 ) ) {
                        $Example['item_name'] = $Item['name'];
                    } // End if
                    
                } // End if   
                
                $data['example_title'] = $Example['name'];
                $data['example'] = $Example;

                $data['data_example_img_path'] = base_url();
                $data['data_example_img_path'] .= '/img/gallery/';
                
                $this->load->view('examples/item', $data);
                $this->load->view('main/footer');   
                    
            } else {
                redirect(base_url(), "refresh");
            } // End if
            
                
        } else {
            redirect(base_url(), "refresh");
        } // End if
                
	} // End item
    
    
} // End class Examples
