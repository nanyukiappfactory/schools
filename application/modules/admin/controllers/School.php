<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends MX_Controller
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
                "title" => "School Admin",
                "content" => $this->load->view("admin/all_schools", $V_data, true),
                "login" => true,
            );
        $this->load->view("admin/layouts/layout", $data);
    }
}

?>
