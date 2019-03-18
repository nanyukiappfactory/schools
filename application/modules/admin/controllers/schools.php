<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
    function __construct()
    {
        parent :: __construct();
        
    }

    public function index()
    {     
        $V_data['title'] = 'Admin Login';
        $data = array
            (
            "title" => "Admin Login",
            "content" => $this->load->view("admin/all_schools", $V_data, true),
            "login" => true,
        );
        $this->load->view("auth/layouts/login_layout", $data);
    }
}
?>
