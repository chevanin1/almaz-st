<?php

class Commondata extends CI_Model {

    protected $base_url = "/";

    public function __construct() {
        parent::__construct();
        
        $this->load->model('catalog');
        
    } // End constructor
    
    
    public function getAllHeaderDatas() {
    
        $result = array();
        
        $result['site_name'] = "Алмаз Строй";
        $result['site_slogan'] = "Строительство домов, бань, любые виды отделки";
        $result['site_contact_phones'] = "8-8342-30-01-50 &nbsp; &nbsp; &nbsp; &nbsp; 8-8342-30-01-86";
        $result['site_contact_address'] = "г. Саранск, ул. Лесная, 2Г";
        $result['site_base_url'] = $this->base_url;
        
        $result['top_menu'] = $this->_getTopMenuData();
        
        return $result;
    
    } // End function getAllHeaderDatas
    
    
    protected function _getTopMenuData() {
    
        $result = array();

        $result[] = array(
            'link' => $this->base_url,
            'title' => "Главная",
            'is_link' => true,
            'a_class' => "active"
        );        

        // Projects categories menu
        $projects_sub_menu = array();
        $projects_sub_menu[] = array(
            'link' => "/catalog/bestsellers/",
            'title' => "Популярные"
        );
        $projects_sub_menu[] = array(
            'link' => "#",
            'title' => "separator",
            'is_separator' => true
        );
        
        $filter = array( 'parent_id' => 0 );
        $ProjectCategories = $this->catalog->GetCategories($filter);
        foreach( $ProjectCategories as $item ) {
            $projects_sub_menu[] = array(
                'link' => "/catalog/categories/" . $item['id'] . "/",
                'title' => $item['name']
            );
        } // End foreach
        
        $result[] = array(
            'link' => "#",
            'title' => "Проекты",
            'is_link' => true,
            'sub_menu' => $projects_sub_menu
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "Наши работы",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "Дополнительные услуги",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "Акции",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "Полезная информация",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "О компании",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "Контакты",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "8-8342-30-01-50 (30-01-86)",
            'is_link' => false,
            'li_class' => "menu-phone-point"
        );      
        
        $result[] = array(
            'link' => "#",
            'title' => "Отправить сообщение",
            'is_link' => true
        );
                
        return $result;
    
    } // End function _getTopMenuData
    
       
    public function getAdminLeftMenu($activeMenuPoint) {
    
        $result = array();
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/index/",
            'title' => "Главная"
        );    
        $result[] = $menu_block;
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/catalog_cat_list/",
            'title' => "Категории каталога"
        );   
        $result[] = $menu_block;          
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/catalog_list/",
            'title' => "Проекты"
        );   
        $result[] = $menu_block;   
        
        foreach( $result as $block_id => $block ) {
            foreach( $block as $item_id => $item ) {
                if( $item['link'] == $activeMenuPoint ) {
                    $result[$block_id][$item_id]['active'] = true;
                } // End if                
            } // End foreach
        } // End foreach
                
        return $result;
    
    } // End function getAdminLeftMenu

} // End Commondata

?>