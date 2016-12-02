<?php

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
    } // End constructor
    
    
    public function Login( $login, $password ) {
    
        $username = "ADMIN";
        if( ( $login == "test@test.ru" ) && ( $password == "pass" ) ) {
            $login_data = array(
                'username'  => $username,
                'email'     => $login,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($login_data);
            return true;
        } else {
            return false;
        } // End if
    
    } // End function Auth
    
    
    public function Logout() {
    
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
    
    } // End function Logout
    
    
    public function isAuth() {
        if( $this->session->userdata('logged_in') ) {
            return true;
        } else {
            return false;
        } // End if
    } // End function isAuth

} // End User

?>