<?php
class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/auth_model');
    }
    /*
     *    Login a admin
     */
    public function login_admin()
    {
        //form validation 
        if($this->session->userdata("admin_login")){
            redirect("admin/schools");
        }else{
            //1. form validation rules
            if (($this->input->post('user_name') == 'admin') && ($this->input->post('user_password') == '123456')) 
            {
                $this->form_validation->set_rules('user_name', 'Username', 'required');
                $this->form_validation->set_rules('user_password', 'Password', 'required');
            } 
            else 
            {
                $this->form_validation->set_rules('user_name', 'Username', 'required');
                $this->form_validation->set_rules('user_password', 'Password', 'required');
            }
            //2. Check if validaion rules pass
            if ($this->form_validation->run()) {
                //     //login hack
                if (($this->input->post('user_name') == 'admin') && ($this->input->post('user_password') == '123456'))  {
                    $newdata = array(
                        'login_status' => true,
                        'user_name' => 'admin',
                        'personnel_type_id' => '1',
                        'first_name' => 'Samuel',
                    );
                    $this->session->set_userdata("admin_login",$newdata);
                    $personnel_type_id = $this->session->userdata('personnel_type_id');
                    if (!empty($personnel_type_id) && ($personnel_type_id != 1)) 
                    {
                        redirect('admin/schools');
                    } 
                    else 
                    {
                        $this->session->set_flashdata('success', ' Welcome back {First name}');
                        redirect('admin/schools');
                    }
                } 
                else {
                    $this->session->set_flashdata('error', ' Incorrect details please try again');
                }
            }
            //3. Condition of validation rules failed
            else {
                $validation_errors = validation_errors();
                if (!empty($validation_errors)) {
                    $this->session->set_flashdata("error", $validation_errors);
                }
                $V_data['title'] = 'Admin Login';
                $data = array(
                    "title" => "Admin Login",
                    "content" => $this->load->view("auth/login", $V_data, true),
                    "login" => true,
                );
                $this->load->view("auth/layouts/layout", $data);
            }
        }
    }
    public function is_logged_in()
    {
        if (!$this->auth_model->check_login()) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
}
