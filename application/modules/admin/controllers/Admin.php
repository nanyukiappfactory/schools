<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
    function __construct()
    {
        parent :: __construct();
        $this->load->model('auth/auth_model');
        if($this->auth_model->check_login() == FALSE)
        {
            redirect('admin/login');
        }
    }
    public function index()
    {     
        // $this->session->set_flashdata('success', 'Welcome back '.$first_name.''); 
        $V_data['title'] = 'Admin Login';
        $data = array
        (
           "title" => "Admin Login",
           "content" => $this->load->view("admin/school/all_schools", $V_data, true),
           "login" => true,
       );
       $this->load->view("admin/layouts/layout", $data);
    }
}

?>
