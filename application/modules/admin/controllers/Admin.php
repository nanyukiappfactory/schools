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
        $newdata = $this->auth_model->validate_user(null, null, $user_name);
        $this->session->set_flashdata('success', 'Welcome back  '. $user_name .' '); 
        redirect('school/all-schools');
    }
    public function admin_logout()
    {
        $this->session->sess_destroy();
        redirect("login");
    }
}
?>
