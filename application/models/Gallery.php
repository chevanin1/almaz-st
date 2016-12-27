<?php

class Gallery extends CI_Model {

    var $data_example_img_path = "";

    public function __construct() {
        parent::__construct();
                
        $this->load->helper('text');
        
        $this->data_example_img_path = base_url('/img/gallery/');
        
    } // End constructor
    
    
    public function getGalleryOnMain() {

        $filter = array();
        $Examples = $this->GetItems($filter, 4);
        
        foreach( $Examples as $id => $row ) {
        
            $Examples[$id]['caption'] = $row['name'];

            if( isset( $Examples[$id]['images'] ) ) {
                foreach( $Examples[$id]['images'] as $image ) {
                    if( $image['num'] == 1 ) {
                        $Examples[$id]['img'] = $this->data_example_img_path . $image['img'];
                    } // End if
                } // End foreach
                unset($Examples[$id]['images']);
            } // End if  
            
            if( !isset($Examples[$id]['img']) ) $Examples[$id]['img'] = base_url('img/nophoto.gif');
            
            $Examples[$id]['link'] = base_url('examples/item/' . $id);
            
        } // End foreach
        
        $result = array_values($Examples);

        return $result;
    
    } // End function getGalleryOnMain
    
    
    public function getGalleryByCat( $CategoryID ) {
        
        $filter = array( 'category_id' => $CategoryID );
        $Examples = $this->GetItems($filter, 4);
        
        foreach( $Examples as $id => $row ) {
        
            $Examples[$id]['caption'] = $row['name'];

            if( isset( $Examples[$id]['images'] ) ) {
                foreach( $Examples[$id]['images'] as $image ) {
                    if( $image['num'] == 1 ) {
                        $Examples[$id]['img'] = $this->data_example_img_path . $image['img'];
                    } // End if
                } // End foreach
                unset($Examples[$id]['images']);
            } // End if  
            
            if( !isset($Examples[$id]['img']) ) $Examples[$id]['img'] = base_url('img/nophoto.gif');
            
            $Examples[$id]['link'] = base_url('examples/item/' . $id);
            
        } // End foreach
        
        $result = array_values($Examples);

        return $result;
    
    } // End function getGalleryByCat
    
    
    public function getGalleryByItem( $ItemID ) {
    
        $filter = array( 'item_id' => $ItemID );
        $Examples = $this->GetItems($filter, 4);
        
        foreach( $Examples as $id => $row ) {
        
            $Examples[$id]['caption'] = $row['name'];

            if( isset( $Examples[$id]['images'] ) ) {
                foreach( $Examples[$id]['images'] as $image ) {
                    if( $image['num'] == 1 ) {
                        $Examples[$id]['img'] = $this->data_example_img_path . $image['img'];
                    } // End if
                } // End foreach
                unset($Examples[$id]['images']);
            } // End if  
            
            if( !isset($Examples[$id]['img']) ) $Examples[$id]['img'] = base_url('img/nophoto.gif');
            
            $Examples[$id]['link'] = base_url('examples/item/' . $id);
            
        } // End foreach
        
        $result = array_values($Examples);

        return $result;
        
    } // End function getGalleryByItem
    
    
    // CRUD
    
/*
CREATE TABLE IF NOT EXISTS `examples_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `example_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/   
 
/*
CREATE TABLE IF NOT EXISTS `examples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `item_id` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/    
    
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
        
        $this->db->insert('examples', $data);
        $ItemID = $this->db->insert_id();
        
        foreach( $img_data as $id => $name ) {
            if( $name != "" ) {
                $this->db->insert('examples_images', array(
                    'num' => $id,
                    'img' => $name,
                    'example_id' => $ItemID
                ));
            } // End if
        } // End foreach

        
        return true;
        
    } // End function AddItem
    
    
    public function GetItem($id) {
        
        $query = $this->db->select("*")->from("examples")->where('id',$id)->limit(1)->get();    
        $result = $query->row_array();
        $query->free_result();
        
        // images info
        $query = $this->db->select("*")->from("examples_images")->where('example_id',$id)->get();    
        foreach ($query->result_array() as $row) {
            $result['img'][$row['num']] = $row;
        } // End foreach
        
        $query->free_result();
        
        return $result;
        
    } // End function GetItem
    
    
    public function GetItems($filter, $limit = 0) {
            
        $result = array();
        $item_ids = array();
        
        $this->db->select("*")->from("examples");
        
        if( is_array( $filter ) && ( count( $filter ) > 0 ) ) {
            foreach( $filter as $filter_field => $filter_val ) {
                if( is_array($filter_val) ) {
                    if( count( $filter_val ) > 0 )
                        $this->db->where_in( $filter_field, $filter_val );
                } else {
                    $this->db->where( $filter_field, $filter_val );
                } // End if
            } // End foreach
        } // End if        
        
        if( $limit > 0 ) {
            $this->db->limit($limit);
        } // End if        
        
        $query = $this->db->get();
                
        foreach($query->result_array() as $row) {
            $item_ids[] = $row['id'];
            $result[$row['id']] = $row;
        } // End foreach
        
        $query->free_result();      

        // Images
        if( count( $item_ids ) > 0 ) {
            
            $query = $this->db->select("*")->from("examples_images")->where_in('example_id', $item_ids)->get();       
            foreach ($query->result_array() as $row) {
                $result[$row['example_id']]['images'][$row['num']] = $row;
            } // End foreach
            
            $query->free_result();
            
        } // End if
   
        return $result;
        
    } // End function GetItems
   
    
    public function UpdateItemsList($data) {
        /*
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
        */
        
        return true;
        
    } // End function UpdateItemsList
    
        
    public function UpdateItem($id, $data) {
        
        $img_data = array();
        if( isset( $data['img'] ) ) {
            $img_data = $data['img'];
            unset($data['img']); 
        } // End if        
        
        $this->db->update('examples',
            $data, 
            array('id' => $id)
            
        );
            
        if( count( $img_data ) > 0  ) {
            $this->db->delete('examples_images', array('example_id' => $id));
            foreach( $img_data as $img_id => $name ) {
                if( $name != "" ) {
                    $this->db->insert('examples_images', array(
                        'num' => $img_id,
                        'img' => $name,
                        'example_id' => $id
                    ));
                } // End if
            } // End foreach 
        } // End if
        
        return true;
    
    } // End function UpdateItem
    
    
    public function DeleteItem($id) {
        
        $this->db->delete('examples_images', array('example_id' => $id));
        $this->db->delete('examples', array('id' => $id));
        
        return true;
    } // End function DeleteItem
    
    
    

} // End Gallery

?>