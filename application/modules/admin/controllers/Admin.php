<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model');
        if ($this->auth_model->check_login() == false) {
            redirect('admin/login');
        }
    }
    public function index()
    {
        $data = $this->session->userdata($newdata);
        $this->session->set_flashdata('success', 'Welcome back  ' . $data['first_name'] . '');
        redirect('schools/all-schools');
    }
    public function admin_logout()
    {
        delete_cookie("user_name");
        delete_cookie("user_password");
        $this->session->unset_userdata("user_name");
        $this->session->sess_destroy();
        redirect("admin/login");
    }

}