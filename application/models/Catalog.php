<?php

class Catalog extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('text');
        
    } // End constructor
    
    
    public function getBestsellers() {
    
        $this->load->library('user_agent');
        
        $data_img_path = base_url();
        $data_img_path .= 'img/items/';
        
        $result = array();
        
        $result = $this->GetItems(array('is_bestseller' => 1), 4);
        
        foreach( $result as $key => $value ) {
        
            $result[$key]['description'] = character_limiter($result[$key]['description'], 100);
            
            if( isset( $result[$key]['images'] ) ) {
                foreach( $result[$key]['images'] as $image ) {
                    if( $image['num'] == 1 ) {
                        $result[$key]['img'] = $data_img_path . $image['name'];
                    } // End if
                } // End foreach
                unset($result[$key]['images']);
            } // End if
            
            $result[$key]['link'] = "/catalog/item/" . $key . "/";
            
        } // End foreach
        
        /*
        $result = array();
        $result[] = array(
            'img' => "/img/gallery/projects/1.jpg",
            'name' => "Проект 1",
            'description' => "Это самы простой проект 1 из материала 1",
            'price' => "400000",            
            'link' => "#",
        );
        
        $result[] = array(
            'img' => "/img/gallery/projects/2.jpg",
            'name' => "Проект 2",
            'description' => "Это самы простой проект 2 из материала 2",
            'price' => "600000",            
            'link' => "#",
        );
        
        $result[] = array(
            'img' => "/img/gallery/projects/3.jpg",
            'name' => "Проект 3",
            'description' => "Это самы простой проект 3 из материала 3",
            'price' => "800000",            
            'link' => "#",
        );
        
        $result[] = array(
            'img' => "/img/gallery/projects/4.jpg",
            'name' => "Проект 4",
            'description' => "Это самы простой проект 4 из материала 4",
            'price' => "1000000",            
            'link' => "#",
        );
        */
        
        return $result;
    
    } // End function getBestsellers
    
    
    ///////////////////////////////////////////////////////////////////////////
    // CATEGORIES
    ///////////////////////////////////////////////////////////////////////////
    
    /*
    project_categories
    
CREATE TABLE IF NOT EXISTS `project_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(100) NOT NULL,
  sort
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    
    */
    
    // mb need to add sort
    
    public function AddCategory($data) {
    
        // mb processing image before save and other
        /*
        echo "data to add<br>";       
        echo "<pre>";
        var_dump( $data );
        echo "</pre>";
        */
        
        $this->db->insert('project_categories', $data);
        
        return true;
        
    } // End function AddCategory
    
    
    public function GetCategory($id) {
    
        $query = $this->db->select("*")->from("project_categories")->where('id',$id)->limit(1)->get();    
    
        return $query->row_array();
        
    } // End function GetCategory
    
    
    public function GetCategories($filter, $hierarchical = false) {
    
        $result = array();
        
        $this->db->select("*")->from("project_categories");
        
        if( is_array( $filter ) && ( count( $filter ) > 0 ) ) {
            $this->db->where($filter);
        } // End if
        
        $query = $this->db->order_by('sort', 'ASC')->get();

        
        /*
        // with group
        $query = $this->db->select("*")->from("project_categories")
            //->group_start()
            //    ->where('',"")
            //    ->where('',"")
            //->group_end()
        ->order_by('sort', 'ASC')
        ->get();
        */
    
        /*
        // compilled query
        echo $this->db->select("*")->from("project_categories")
            //->group_start()
            //    ->where('',"")
            //    ->where('',"")
            //->group_end()
        //->order_by('name', 'ASC')
        ->get_compiled_select();
        */      
        
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        } // End foreach
        
        $query->free_result();
   
        return $result;
        
    } // End function GetCategories


    public function GetCategoriesJson($categories) {
    
        $result = array();
        
        foreach( $categories as $category ) {
            if( $category['parent_id'] == 0 ) {
                $row = array( 'id' => $category['id'] );
                
                foreach( $categories as $sub_category ) {
                    if( $sub_category['parent_id'] == $category['id'] ) {
                        $row['children'][] = array( 'id' => $category['id'] );
                    } // End if
                } // End foreach
                
                $result[] = $row;
            } // End if
        } // End foreach
    
        return htmlspecialchars(json_encode($result));
        
    } // End function GetCategories
    
    
    public function UpdateCategoriesListFromJSON($JSON_str) {
        
        $JSON_array = json_decode($JSON_str, true);
        
        if( is_array( $JSON_array ) && ( count($JSON_array) > 0 ) ) {
            
            $sort = 0;
            foreach( $JSON_array as $category ) {
            
                $sort++;
                
                $this->db->update('project_categories', 
                    array(
                        'parent_id' => 0,
                        'sort' => $sort
                    ), 
                    array('id' => $category['id'])
                );
                
                if( isset( $category['children'] ) && is_array( $category['children'] ) && ( count($category['children']) > 0 ) ) {
                
                    foreach( $category['children'] as $sub_category ) {
                    
                        $sort++;
                        
                        $this->db->update('project_categories', 
                            array(
                                'parent_id' => $category['id'],
                                'sort' => $sort
                            ), 
                            array('id' => $sub_category['id'])
                        );
                
                    } // End foreach
                    
                } // End if
                
            } // End foreach
            
        } // End if
        
        return true;
        
    } // End function UpdateCategoriesListFromJSON
       
        
    public function UpdateCategory($id, $data) {
        
        $this->db->update('project_categories',
            $data, 
            array('id' => $id)
        );
        
        return true;
    
    } // End function UpdateCategory
    
    
    public function DeleteCategory($id) {
        $this->db->delete('project_categories', array('parent_id' => $id));
        $this->db->delete('project_categories', array('id' => $id));
        return true;
    } // End function DeleteCategory
    
       
    ///////////////////////////////////////////////////////////////////////////
    // CATEGORIES END
    ///////////////////////////////////////////////////////////////////////////
    
    
    ///////////////////////////////////////////////////////////////////////////
    // ITEMS
    ///////////////////////////////////////////////////////////////////////////
    
    
    // CRUD
    // GET    
    /*
    projects
    
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `is_bestseller` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    
    */
    
    /*
CREATE TABLE  `dom`.`project_images` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`num` INT NOT NULL ,
`name` VARCHAR( 100 ) NOT NULL
item_id
) ENGINE = MYISAM ;    
    */
    
    // mb need to add sort
    
    public function AddItem($data) {
    
        // mb processing image before save and other
        /*
        echo "data to add<br>";       
        echo "<pre>";
        var_dump( $data );
        echo "</pre>";
        */
        
        $img_data = $data['img'];
        unset($data['img']);       
        
        $this->db->insert('projects', $data);
        $ItemID = $this->db->insert_id();
        
        foreach( $img_data as $id => $name ) {
            if( $name != "" ) {
                $this->db->insert('project_images', array(
                    'num' => $id,
                    'name' => $name,
                    'item_id' => $ItemID
                ));
            } // End if
        } // End foreach
        
        return true;
        
    } // End function AddItem
    
    
    public function GetItem($id) {
    
        $query = $this->db->select("*")->from("projects")->where('id',$id)->limit(1)->get();    
        $result = $query->row_array();
        $query->free_result();
        
        // images info
        $query = $this->db->select("*")->from("project_images")->where('item_id',$id)->get();    
        foreach ($query->result_array() as $row) {
            $result['img'][$row['num']] = $row;
        } // End foreach
        
        $query->free_result();
        
        $result['price'] = floatval($result['price']);
        
        return $result;
        
    } // End function GetItem
    
    
    public function GetItems($filter, $limit = 0) {
            
        $result = array();
        $item_ids = array();
        
        $this->db->select("*")->from("projects");
        
        if( is_array( $filter ) && ( count( $filter ) > 0 ) ) {
            $this->db->where($filter);
        } // End if
        
        if( $limit > 0 ) {
            $this->db->limit($limit);
        } // End if
        
        $query = $this->db->order_by('sort', 'ASC')->get();
        /*
        $query = $this->db->order_by('sort', 'ASC')->get_compiled_select();
        echo $query;
        */
       
        foreach ($query->result_array() as $row) {
            $row['price'] = floatval($row['price']);
            $item_ids[] = $row['id'];
            $result[$row['id']] = $row;
        } // End foreach
        
        $query->free_result();
        
        // Images
        $query = $this->db->select("*")->from("project_images")->where_in('item_id', $item_ids)->get();       
        foreach ($query->result_array() as $row) {
            $result[$row['item_id']]['images'][$row['num']] = $row;
        } // End foreach
        
        $query->free_result();
   
        return $result;
        
    } // End function GetItems
   
    
    public function UpdateItemsList($data) {
            
        if( is_array( $data ) && ( count($data) > 0 ) ) {
            
            foreach( $data as $id => $item ) {
            
                $this->db->update('projects', 
                    array(
                        'sort' => $item['sort'],
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'is_bestseller' => $item['is_bestseller']
                    ), 
                    array( 'id' => $id )
                );
                
            } // End foreach
            
        } // End if
        
        return true;
        
    } // End function UpdateItemsList
    
        
    public function UpdateItem($id, $data) {
        
        $img_data = $data['img'];
        unset($data['img']);    
        
        $this->db->update('projects',
            $data, 
            array('id' => $id)
            
        );
                
        $this->db->delete('project_images', array('item_id' => $id));
        foreach( $img_data as $img_id => $name ) {
            if( $name != "" ) {
                $this->db->insert('project_images', array(
                    'num' => $img_id,
                    'name' => $name,
                    'item_id' => $id
                ));
            } // End if
        } // End foreach        
        
        return true;
    
    } // End function UpdateItem
    
    
    public function DeleteItem($id) {
        /*
        $this->db->delete('project_categories', array('parent_id' => $id));
        $this->db->delete('project_categories', array('id' => $id));
        */
        return true;
    } // End function DeleteItem
    
       
    ///////////////////////////////////////////////////////////////////////////
    // ITEMS END
    ///////////////////////////////////////////////////////////////////////////
    
    

    

} // End Catalog

?>