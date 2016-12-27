<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// /admin/<table>/<action>/<id>

/*
предусмотреть переход по url при потере авторизации
*/

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->helper('security');
        
        //$this->lang->load('russian');
        
        
        $this->load->model('user'); 
        $this->load->model('commondata'); 
        
    } // End constructor
    
    public function index() {
    
        if( $this->user->isAuth() ) {
            
            $header_data = array();
            $data = array();
            $left_menu = array();
            $footer = array();
            
            $header_data['user_name'] = "";
            
            $activeMenuPoint = "/";
            $activeMenuPoint .= $this->uri->segment(1);
            $activeMenuPoint .= "/";
            $activeMenuPoint .= $this->uri->segment(2);
            $activeMenuPoint .= "/";
            
            $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
            
            $data['header'] = "";
            
            $this->load->view('admin/header', $header_data);
            $this->load->view('admin/left_menu', $left_menu);
            $this->load->view('admin/index', $data);
            $this->load->view('admin/footer', $footer);
            
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function index
    
    
    ///////////////////////////////////////////////////
    // CATALOG
    ///////////////////////////////////////////////////
    
    // categories - list+add+edit+delete+parent in list + link to items in category
    
    
    public function catalog_cat_list() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() ) {
            
            $header_data = array();
            $data = array();
            $left_menu = array();
            $footer = array();
            
            $header_data['user_name'] = "";
            
            $activeMenuPoint = "/";
            $activeMenuPoint .= $this->uri->segment(1);
            $activeMenuPoint .= "/";
            $activeMenuPoint .= $this->uri->segment(2);
            $activeMenuPoint .= "/";
            
            $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
            
            $data['header'] = "Категории проектов";
            
            $filter = array();
            $data['items'] = $this->catalog->GetCategories($filter, true);
            $data['items_json'] = $this->catalog->GetCategoriesJson( $data['items'] );           
            
            $this->load->view('admin/header', $header_data);
            $this->load->view('admin/left_menu', $left_menu);
            $this->load->view('admin/projects/cat_list', $data);
            $this->load->view('admin/footer', $footer);
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_cat_list
    
       
    public function catalog_cat_list_action() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() ) {
            
            if( $this->input->post('items_json', true) ) {
                
                $actionResult = $this->catalog->UpdateCategoriesListFromJSON($this->input->post('items_json', true));
                
            } // End if
            
            redirect("/admin/catalog_cat_list/", "refresh");
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_cat_list_action    
    
    
    public function catalog_cat_add() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() ) {

            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules
            $this->form_validation->set_rules('name', 'lang:cat_name', 'required|max_length[50]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 50 символов"
                )
            );            
            //$this->form_validation->set_rules('img', 'lang:img', '');            
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/projects/categories/';
            $upload_config['allowed_types']        = 'gif|jpg|png';
            /*
            $upload_config['max_size']             = 100;
            $upload_config['max_width']            = 1024;
            $upload_config['max_height']           = 768;
            */

            $this->load->library('upload', $upload_config);
            
            // Form validation
            $processing_error = true;
            $img_error = "";
            $data_img = false;
            $data_img_name = false;
            
            if( $this->form_validation->run() == true ) {
                if( !empty($_FILES['img']['name']) ) {
                    $data_img_name = xss_clean($_FILES['img']['name']);
                    if( !$this->upload->do_upload('img') ) {
                        $img_error = $this->upload->display_errors();
                    } else {
                        $data_img = $this->upload->data();
                        $processing_error = false;
                    } // End if
                } else {
                    $processing_error = false;
                } // End if                
                
            } // End if          
        
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/catalog_cat_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Новая категория";
                
                // For parent select
                $filter = array();
                $data['top_categories'] = array();
                $data['top_categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Верхний уровень" );
                $data['top_categories'] = array_merge( $data['top_categories'], $this->catalog->GetCategories($filter, true) );
                // Only top level categories
                foreach( $data['top_categories'] as $key => $value ) {
                    if( $value['parent_id'] != 0 ) unset( $data['top_categories'][$key] );
                } // End foreach
                
                // Image upload data and error
                /*
                if( $data_img !== false ) {
                    $data['img_name'] = $data_img['name'];
                } // End if
                */
                
                if( $data_img_name !== false ) {
                    $data['img_name'] = $data_img_name;
                } else {
                    $data['img_name'] = "";
                } // End if
                
                $data['img_error'] = $img_error;
                
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/projects/cat_add', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {
                
                $dataToAdd = array(
                    'name' => $this->input->post('name', true),
                    'parent_id' => $this->input->post('parent', true),
                    'description' => $this->input->post('description', true),
                    'img' => $data_img['file_name']
                );
                
                $this->catalog->AddCategory($dataToAdd);
                redirect("/admin/catalog_cat_list/", "refresh");                
                
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_cat_add   
 
        
    public function catalog_cat_edit() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
            
            $CategoryID = $this->uri->segment(3);
            $CategoryInfo = $this->catalog->GetCategory($CategoryID);

            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules
            $this->form_validation->set_rules('name', 'lang:cat_name', 'required|max_length[50]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 50 символов"
                )
            );            
            //$this->form_validation->set_rules('img', 'lang:img', '');            
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/projects/categories/';
            $upload_config['allowed_types']        = 'gif|jpg|png';
            /*
            $upload_config['max_size']             = 100;
            $upload_config['max_width']            = 1024;
            $upload_config['max_height']           = 768;
            */

            $this->load->library('upload', $upload_config);
            
            // Form validation
            $processing_error = true;
            $img_error = "";
            $data_img = false;
            $data_img_name = $CategoryInfo['img'];
            
            if( $this->form_validation->run() == true ) {
                if( !empty($_FILES['img']['name']) ) {
                    $data_img_name = xss_clean($_FILES['img']['name']);
                    if( !$this->upload->do_upload('img') ) {
                        $img_error = $this->upload->display_errors();
                    } else {
                        $data_img = $this->upload->data();
                        $processing_error = false;
                    } // End if
                } else {
                    $processing_error = false;
                } // End if                
                
            } // End if          
        
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/catalog_cat_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Редактирование категории \"" . $CategoryInfo['name'] . "\"";
                $data['category_info'] = $CategoryInfo;
                $data['data_img_path'] = base_url();
                $data['data_img_path'] .= '/img/projects/categories/';
                
                // For parent select
                $filter = array();
                $data['top_categories'] = array();
                $data['top_categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Верхний уровень" );
                $data['top_categories'] = array_merge( $data['top_categories'], $this->catalog->GetCategories($filter, true) );
                // Only top level categories
                foreach( $data['top_categories'] as $key => $value ) {
                    if( $value['parent_id'] != 0 ) unset( $data['top_categories'][$key] );
                } // End foreach
                
                // Image upload data and error
                /*
                if( $data_img !== false ) {
                    $data['img_name'] = $data_img['name'];
                } // End if
                */
                
                if( $data_img_name !== false ) {
                    $data['img_name'] = $data_img_name;
                } else {
                    $data['img_name'] = "";
                } // End if
                
                $data['img_error'] = $img_error;
                
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/projects/cat_edit', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {
                
                // img - need right processing
                $dataToEdit = array(
                    'name' => $this->input->post('name', true),
                    'parent_id' => $this->input->post('parent', true),
                    'description' => $this->input->post('description', true),
                );
                if( $data_img ) $dataToEdit['img'] = $data_img['file_name'];
                
                if( $this->input->post('delete_img', true) ) $dataToEdit['img'] = "";
                
                $this->catalog->UpdateCategory($CategoryID, $dataToEdit);
                redirect("/admin/catalog_cat_list/", "refresh");                
                
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_cat_edit   
    
    
    public function catalog_cat_delete() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
            
            $CategoryID = $this->uri->segment(3);
                
            $this->catalog->DeleteCategory($CategoryID);
            redirect("/admin/catalog_cat_list/", "refresh");                
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_cat_delete

    
    public function catalog_list() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() ) {
        
            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            $filter = array();
            $Projects = $this->catalog->GetItems($filter);
            
            // Form validation rules and other form values
            $is_bestseller_values = array();
            foreach( $Projects as $item ) {
                $this->form_validation->set_rules('name_' . $item['id'], 'lang:name', 'required|max_length[100]',
                    array(
                    'required' => "Поле \"{field}\" должно быть заполнено", 
                    'max_length' => "Поле \"{field}\" не должно быть длиннее 100 символов"
                    )
                );                 
                $this->form_validation->set_rules('sort_' . $item['id'], 'lang:sort', 'required|integer',
                    array(
                    'required' => "Поле \"{field}\" должно быть заполнено", 
                    'integer' => "Поле \"{field}\" должно быть целым числом, например 0,1,100,..."
                    )
                );                 
                $this->form_validation->set_rules('price_' . $item['id'], 'lang:price', 'required|numeric',
                    array(
                    'required' => "Поле \"{field}\" должно быть заполнено", 
                    'numeric' => "Поле \"{field}\" должно быть числом"
                    )
                );       

                if( $this->input->post('is_bestseller_' . $item['id'], true) ) {
                    $is_bestseller_values[$item['id']] = $this->input->post('is_bestseller_' . $item['id'], true);
                } // End if
                
            } // End foreach
                        
            // Form validation
            if( $this->form_validation->run() == false ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/";
                $activeMenuPoint .= $this->uri->segment(1);
                $activeMenuPoint .= "/";
                $activeMenuPoint .= $this->uri->segment(2);
                $activeMenuPoint .= "/";
                
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Проекты";
                
                $filter = array();
                $data['categories'] = $this->catalog->GetCategories($filter, true);
                
                $data['items'] = $Projects;
                $data['is_bestseller_values'] = $is_bestseller_values;
                
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);
                $this->load->view('admin/projects/list', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {

                $dataToEdit = array();
                foreach( $Projects as $item ) {
                
                    $data = array();
                    if( $this->input->post('name_' . $item['id'], true) ) {
                        $data['name'] = $this->input->post('name_' . $item['id'], true);
                    } // End if
                    if( $this->input->post('sort_' . $item['id'], true) ) {
                        $data['sort'] = $this->input->post('sort_' . $item['id'], true);
                    } // End if
                    if( $this->input->post('price_' . $item['id'], true) ) {
                        $data['price'] = $this->input->post('price_' . $item['id'], true);
                    } // End if
                    if( $this->input->post('is_bestseller_' . $item['id'], true) && ( $this->input->post('is_bestseller_' . $item['id'], true) == "on" ) ) {
                        $data['is_bestseller'] = 1;
                    } else {
                        $data['is_bestseller'] = 0;
                    } // End if
                    
                    $dataToEdit[$item['id']] = $data;
                    
                } // End foreach
                               
                $this->catalog->UpdateItemsList($dataToEdit);
                redirect("/admin/catalog_list/", "refresh");                
                
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_list
    
    
    public function catalog_add() {
    
        $this->load->model('catalog');
        $ImagesCount = 5; // to config
    
        if( $this->user->isAuth() ) {
        
            // разбиваем на валидацию полей формы и картинок
            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules and other form values
            $this->form_validation->set_rules('name', 'lang:name', 'required|max_length[100]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 100 символов"
                )
            );                 
            $this->form_validation->set_rules('sort', 'lang:sort', 'required|integer',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'integer' => "Поле \"{field}\" должно быть целым числом, например 0,1,100,..."
                )
            );                 
            $this->form_validation->set_rules('price', 'lang:price', 'required|numeric',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'numeric' => "Поле \"{field}\" должно быть числом"
                )
            );       
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/items/';
            $upload_config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $upload_config);
            
            // Form validation
            $processing_error = true;
            //$img_error = "";
            $data_img = array();
            //$data_img_name = false;
            
            $img_error = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                $img_error[$i] = "";
            } // End for
            
            $img_name = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                if( $this->input->post('uploaded_' . $i, true) && ( $this->input->post('uploaded_' . $i, true) != "" ) ) {
                    $img_name[$i] = $this->input->post('uploaded_' . $i, true);
                } else {
                    $img_name[$i] = "";
                } // End if
                //uploaded_$i;
            } // End for   
            
            // Upload images validation
            if( $this->form_validation->run() == true ) {
            
                $have_img_errors = false;
                
                for( $i = 1; $i <= $ImagesCount; $i++ ) {
                    if( !empty($_FILES['img_' . $i]['name']) ) {
                        $img_name[$i] = xss_clean($_FILES['img_' . $i]['name']);
                        if( !$this->upload->do_upload('img_' . $i) ) {
                            $img_error[$i] = $this->upload->display_errors();
                            $have_img_errors = true;
                        } else {
                            $data_img[$i] = $this->upload->data();
                            $img_name[$i] = $data_img[$i]['file_name'];
                        } // End if
                    } // End if
                } // End for

                if( !$have_img_errors ) $processing_error = false;
                
            } // End if          
            
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/catalog_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Новый проект";
                
                // For category select
                $filter = array();
                $data['top_categories'] = array();
                $data['top_categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Верхний уровень" );
                $data['top_categories'] = array_merge( $data['top_categories'], $this->catalog->GetCategories($filter, true) );
                
                // Images Info
                $data['data_img_path'] = base_url();
                $data['data_img_path'] .= '/img/items/';
                
                $data['images_count'] = $ImagesCount;
                $data['img_error'] = $img_error;
                $data['img_name'] = $img_name;
                
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/projects/add', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {
                
                $is_bestseller = 0;
                if( $this->input->post('is_bestseller', true) && ( $this->input->post('is_bestseller', true) == "on" ) ) {
                    $is_bestseller = 1;
                } // End if                
                $dataToAdd = array(
                    'sort' => $this->input->post('sort', true),
                    'name' => $this->input->post('name', true),
                    'price' => $this->input->post('price', true),
                    'category_id' => $this->input->post('category_id', true),
                    'description' => $this->input->post('description', true),
                    'is_bestseller' => $is_bestseller,
                    'img' => $img_name
                );                
                $this->catalog->AddItem($dataToAdd);
                redirect("/admin/catalog_list/", "refresh");   
                                              
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_add   
 
       
    public function catalog_edit() {
   
        $this->load->model('catalog');
        $ImagesCount = 5; // to config
        
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
        
            $ItemID = $this->uri->segment(3);
            $ItemInfo = $this->catalog->GetItem($ItemID); 
        
            // разбиваем на валидацию полей формы и картинок
            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules and other form values
            $this->form_validation->set_rules('name', 'lang:name', 'required|max_length[100]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 100 символов"
                )
            );                 
            $this->form_validation->set_rules('sort', 'lang:sort', 'required|integer',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'integer' => "Поле \"{field}\" должно быть целым числом, например 0,1,100,..."
                )
            );                 
            $this->form_validation->set_rules('price', 'lang:price', 'required|numeric',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'numeric' => "Поле \"{field}\" должно быть числом"
                )
            );       
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/items/';
            $upload_config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $upload_config);
            
            // Form validation
            $processing_error = true;
            //$img_error = "";
            $data_img = array();
            //$data_img_name = false;
            
            $img_error = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                $img_error[$i] = "";
            } // End for
            
            $img_name = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                if( $this->input->post('uploaded_' . $i, true) && ( $this->input->post('uploaded_' . $i, true) != "" ) ) {
                    $img_name[$i] = $this->input->post('uploaded_' . $i, true);
                } else {
                    if( isset($ItemInfo['img'][$i]) ) {
                        $img_name[$i] = $ItemInfo['img'][$i]['name'];
                    } else {
                        $img_name[$i] = "";
                    } // End if
                } // End if
                //uploaded_$i;
            } // End for   
            
            // Upload images validation
            if( $this->form_validation->run() == true ) {
            
                $have_img_errors = false;
                
                for( $i = 1; $i <= $ImagesCount; $i++ ) {
                    if( !empty($_FILES['img_' . $i]['name']) ) {
                        $img_name[$i] = xss_clean($_FILES['img_' . $i]['name']);
                        if( !$this->upload->do_upload('img_' . $i) ) {
                            $img_error[$i] = $this->upload->display_errors();
                            $have_img_errors = true;
                        } else {
                            $data_img[$i] = $this->upload->data();
                            $img_name[$i] = $data_img[$i]['file_name'];
                        } // End if
                    } // End if
                } // End for

                if( !$have_img_errors ) $processing_error = false;
                
            } // End if          
            
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/catalog_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Редактирование проекта " . $ItemInfo['name'];
                $data['item_info'] = $ItemInfo;
                
                // For category select
                $filter = array();
                $data['top_categories'] = array();
                $data['top_categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Верхний уровень" );
                $data['top_categories'] = array_merge( $data['top_categories'], $this->catalog->GetCategories($filter, true) );
                
                // Images Info
                $data['data_img_path'] = base_url();
                $data['data_img_path'] .= '/img/items/';
                
                $data['images_count'] = $ImagesCount;
                $data['img_error'] = $img_error;
                $data['img_name'] = $img_name;
                
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/projects/edit', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {
                
                
                $is_bestseller = 0;
                if( $this->input->post('is_bestseller', true) && ( $this->input->post('is_bestseller', true) == "on" ) ) {
                    $is_bestseller = 1;
                } // End if                
                $dataToEdit = array(
                    'sort' => $this->input->post('sort', true),
                    'name' => $this->input->post('name', true),
                    'price' => $this->input->post('price', true),
                    'category_id' => $this->input->post('category_id', true),
                    'description' => $this->input->post('description', true),
                    'is_bestseller' => $is_bestseller,
                    'img' => $img_name
                );                
                $this->catalog->UpdateItem($ItemID, $dataToEdit);
                
                redirect("/admin/catalog_list/", "refresh");   
                                              
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
         
    } // End function catalog_edit   
 
       
    public function catalog_copy() {
   
        $this->load->model('catalog');
        $ImagesCount = 5; // to config
        
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
        
            $ItemID = $this->uri->segment(3);
            $ItemInfo = $this->catalog->GetItem($ItemID); 
            
            // Processing $ItemInfo            
            unset($ItemInfo['id']);
            
            if( isset( $ItemInfo['img'] ) ) {
                $img_name = array();
                foreach( $ItemInfo['img'] as $key => $value ) {
                    $img_name[$key] = $ItemInfo['img'][$key]['name'];
                } // End foreach
                $ItemInfo['img'] = $img_name;
            } // End if
            
            // Saving $ItemInfo
            $NewItemID = $this->catalog->AddItem($ItemInfo);           
            redirect("/admin/catalog_edit/" . $NewItemID, "refresh");             
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
         
    } // End function catalog_edit   
    
    
    public function catalog_delete() {
    
        $this->load->model('catalog');
    
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
            $ElementID = $this->uri->segment(3);
            $this->catalog->DeleteItem($ElementID);
            redirect("/admin/catalog_list/", "refresh");     
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function catalog_delete

      
    ///////////////////////////////////////////////////
    // CATALOG END
    ///////////////////////////////////////////////////
  
  
    ///////////////////////////////////////////////////
    // EXAMPLES BEGIN
    ///////////////////////////////////////////////////
     
    public function examples_list() {
    
        $this->load->model('gallery');
        $this->load->model('catalog');
        $this->load->library('user_agent');   
        
        if( $this->user->isAuth() ) {

            $filter = array();
            $Examples = $this->gallery->GetItems($filter);
            
            $header_data = array();
            $data = array();
            $left_menu = array();
            $footer = array();     

            $data['header'] = "Примеры работ (Галереи)";
            
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
                } // End if

                if( isset( $value['item_id'] ) && ( $value['item_id'] != 0 ) ) {
                    $ItemIDs[] = $value['item_id'];
                } // End if
                
            } // End foreach         
            
            $data['items'] = $Examples;
            
            if( count($CategoryIDs) > 0 ) {
                $filter = array( 'id' => $CategoryIDs);
                $data['categories'] = $this->catalog->GetCategories($filter);
            } else {
                $data['categories'] = array();
            } // End if
            
            if( count($ItemIDs) > 0 ) {
                $filter = array( 'id' => $ItemIDs);
                $data['projects'] = $this->catalog->GetItems($filter);
            } else {
                $data['projects'] = array();
            } // End if
            
            // Images Info
            $data['data_img_path'] = base_url();
            $data['data_img_path'] .= '/img/gallery/';

            $header_data['user_name'] = "";
            
            $activeMenuPoint = "/";
            $activeMenuPoint .= $this->uri->segment(1);
            $activeMenuPoint .= "/";
            $activeMenuPoint .= $this->uri->segment(2);
            $activeMenuPoint .= "/";
            
            $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                    
            $this->load->view('admin/header', $header_data);
            $this->load->view('admin/left_menu', $left_menu);
            $this->load->view('admin/examples/list', $data);
            $this->load->view('admin/footer', $footer);      
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function examples_list
    
    
    public function example_add() {
    
        $this->load->model('gallery');
        $this->load->model('catalog');
        $ImagesCount = 10; // to config
    
        if( $this->user->isAuth() ) {
        
            // разбиваем на валидацию полей формы и картинок
            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules and other form values
            $this->form_validation->set_rules('name', 'lang:name', 'required|max_length[100]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 100 символов"
                )
            );                      
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/gallery/';
            $upload_config['allowed_types']        = 'gif|jpg|png';
            $this->load->library('upload', $upload_config);
                       
            // Form validation
            $processing_error = true;
            //$img_error = "";
            $data_img = array();
            //$data_img_name = false;
            
            $img_error = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                $img_error[$i] = "";
            } // End for
            
            $img_name = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                if( $this->input->post('uploaded_' . $i, true) && ( $this->input->post('uploaded_' . $i, true) != "" ) ) {
                    $img_name[$i] = $this->input->post('uploaded_' . $i, true);
                } else {
                    $img_name[$i] = "";
                } // End if
                //uploaded_$i;
            } // End for   
            
            // Upload images validation
            if( $this->form_validation->run() == true ) {
            
                $have_img_errors = false;
                
                for( $i = 1; $i <= $ImagesCount; $i++ ) {
                    if( !empty($_FILES['img_' . $i]['name']) ) {
                        $img_name[$i] = xss_clean($_FILES['img_' . $i]['name']);
                        if( !$this->upload->do_upload('img_' . $i) ) {
                            $img_error[$i] = $this->upload->display_errors();
                            $have_img_errors = true;
                        } else {
                            $data_img[$i] = $this->upload->data();
                            $img_name[$i] = $data_img[$i]['file_name'];
                        } // End if
                    } // End if
                } // End for

                if( !$have_img_errors ) $processing_error = false;
                
            } // End if          
            
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/examples_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Новая галерея примеров";
                              
                // For category select
                $filter = array();
                $data['categories'] = array();
                $data['categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Без категории" );
                $data['categories'] = array_merge( $data['categories'], $this->catalog->GetCategories($filter, true) );
                
                // For project select
                $filter = array();
                $data['projects'] = array();
                $data['projects'][] = array( 'id' => 0, 'name' => "Без проекта" );
                $data['projects'] = array_merge( $data['projects'], $this->catalog->GetItems($filter) );
                
                // Images Info
                $data['data_img_path'] = base_url();
                $data['data_img_path'] .= '/img/gallery/';
                               
                $data['images_count'] = $ImagesCount;
                $data['img_error'] = $img_error;
                $data['img_name'] = $img_name;
                              
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/examples/add', $data);
                $this->load->view('admin/footer', $footer);
            
            } else {

                $dataToAdd = array(
                    'name' => $this->input->post('name', true),
                    'category_id' => $this->input->post('category_id', true),
                    'item_id' => $this->input->post('item_id', true),
                    'description' => $this->input->post('description', true),
                    'img' => $img_name
                );                
                $this->gallery->AddItem($dataToAdd);
                redirect("/admin/examples_list/", "refresh");   
                                                             
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function example_add   
 
       
    public function example_edit() {
    
        $this->load->model('gallery');
        $this->load->model('catalog');
        $ImagesCount = 10; // to config
    
        if( $this->user->isAuth() && $this->uri->segment(3) ) {
        
            $ItemID = $this->uri->segment(3);
            $ItemInfo = $this->gallery->GetItem($ItemID); 
            
            // разбиваем на валидацию полей формы и картинок
            $this->load->library('form_validation');
            $this->load->library('user_agent');
            
            // Form validation rules and other form values
            $this->form_validation->set_rules('name', 'lang:name', 'required|max_length[100]',
                array(
                'required' => "Поле \"{field}\" должно быть заполнено", 
                'max_length' => "Поле \"{field}\" не должно быть длиннее 100 символов"
                )
            );                      
            
            // Image upload settings and rules
            $upload_config['upload_path']          = FCPATH . '/img/gallery/';
            $upload_config['allowed_types']        = 'gif|jpg|png';
            $this->load->library('upload', $upload_config);
                       
            // Form validation
            $processing_error = true;
            //$img_error = "";
            $data_img = array();
            //$data_img_name = false;
            
            $img_error = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                $img_error[$i] = "";
            } // End for
            
            $img_name = array();
            for( $i = 1; $i <= $ImagesCount; $i++ ) {
                if( $this->input->post('uploaded_' . $i, true) && ( $this->input->post('uploaded_' . $i, true) != "" ) ) {
                    $img_name[$i] = $this->input->post('uploaded_' . $i, true);
                } else {
                    if( isset($ItemInfo['img'][$i]) ) {
                        $img_name[$i] = $ItemInfo['img'][$i]['img'];
                    } else {
                        $img_name[$i] = "";
                    } // End if
                } // End if
                //uploaded_$i;
            } // End for   
            
            // Upload images validation
            if( $this->form_validation->run() == true ) {
            
                $have_img_errors = false;
                
                for( $i = 1; $i <= $ImagesCount; $i++ ) {
                    if( !empty($_FILES['img_' . $i]['name']) ) {
                        $img_name[$i] = xss_clean($_FILES['img_' . $i]['name']);
                        if( !$this->upload->do_upload('img_' . $i) ) {
                            $img_error[$i] = $this->upload->display_errors();
                            $have_img_errors = true;
                        } else {
                            $data_img[$i] = $this->upload->data();
                            $img_name[$i] = $data_img[$i]['file_name'];
                        } // End if
                    } // End if
                } // End for

                if( !$have_img_errors ) $processing_error = false;
                
            } // End if       
            
            if( $processing_error ) {
                
                $header_data = array();
                $data = array();
                $left_menu = array();
                $footer = array();
                
                $header_data['user_name'] = "";
                
                $activeMenuPoint = "/admin/examples_list/";            
                $left_menu['menu'] = $this->commondata->getAdminLeftMenu($activeMenuPoint);
                
                $data['header'] = "Редактирование галереи " . $ItemInfo['name'];
                $data['item_info'] = $ItemInfo;
                              
                // For category select
                $filter = array();
                $data['categories'] = array();
                $data['categories'][] = array( 'id' => 0, 'parent_id' => 0, 'name' => "Без категории" );
                $data['categories'] = array_merge( $data['categories'], $this->catalog->GetCategories($filter, true) );
                
                // For project select
                $filter = array();
                $data['projects'] = array();
                $data['projects'][] = array( 'id' => 0, 'name' => "Без проекта" );
                $data['projects'] = array_merge( $data['projects'], $this->catalog->GetItems($filter) );
                
                // Images Info
                $data['data_img_path'] = base_url();
                $data['data_img_path'] .= '/img/gallery/';
                               
                $data['images_count'] = $ImagesCount;
                $data['img_error'] = $img_error;
                $data['img_name'] = $img_name;
                              
                $this->load->view('admin/header', $header_data);
                $this->load->view('admin/left_menu', $left_menu);           
                $this->load->view('admin/examples/edit', $data);
                $this->load->view('admin/footer', $footer);
                
            } else {
                
                $dataToEdit = array(
                    'name' => $this->input->post('name', true),
                    'category_id' => $this->input->post('category_id', true),
                    'item_id' => $this->input->post('item_id', true),
                    'description' => $this->input->post('description', true),
                    'img' => $img_name
                );                
                $this->gallery->UpdateItem($ItemID, $dataToEdit);
                redirect("/admin/examples_list/", "refresh");   
                                                             
            } // End if
            
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function example_edit   
    
    
    public function example_delete() {
    
        $this->load->model('gallery');
    
        if( $this->user->isAuth() && $this->uri->segment(3) ) {                      
            $ElementID = $this->uri->segment(3);                
            $this->gallery->DeleteItem($ElementID);
            redirect("/admin/examples_list/", "refresh");                                   
        } else {
            redirect("/admin/auth/", "refresh");
        } // End if
        
    } // End function example_delete

      
    ///////////////////////////////////////////////////
    // EXAMPLES END
    ///////////////////////////////////////////////////
  
  
    public function auth() {
        
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        
        $this->form_validation->set_rules('login', 'lang:login', 'required|valid_email',
            array('required' => "Поле \"{field}\" должно быть заполнено", 'valid_email' => "Поле \"{field}\" должно содержать адрес электронной почты")
        );
        $this->form_validation->set_rules('password', 'lang:password', 'required',
            array('required' => "Поле \"{field}\" должно быть заполнено")
        );
        
        $data = array();
        
        if( $this->input->post('redirect_url', true) ) {
            $data['redirect_url'] = $this->input->post('redirect_url', true);
        } else {
            
            $referer = $this->agent->referrer();
            if( $referer != "" ) {
                $data['redirect_url'] = $this->agent->referrer();
            } else {
                $data['redirect_url'] = base_url();
                $data['redirect_url'] .= "admin/index/";
            } // End if
            
        } // End if
        
        if( $this->form_validation->run() == FALSE ) {
            $this->load->view('admin/auth_form', $data);
        } else {
        
            $login = $this->input->post('login', true);
            $password = $this->input->post('password', true);
            
            
            if( $this->user->Login( $login, $password ) ) {
                redirect($this->input->post('redirect_url', true), "refresh");
            } else {
                $data['auth_error'] = "Неверные логин или пароль";
                $this->load->view('admin/auth_form', $data);
            } // End if
        
        } // End if
        
    } // End function auth
    
    
    public function logout() {
        $this->user->Logout();
        echo "go to auth form";
    } // End function logout
     
} // End Class Admin
?>