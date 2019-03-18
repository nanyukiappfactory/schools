<?php if (!defined('BASEPATH')) { exit('No direct access script allowed'); }

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }
    /*
     *    Login a admin
     */
    public function index()
    {
        //form validation 
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
            
        //2. Check if validation rules pass
                if ($this->form_validation->run() == true) 
                {
                    $user_name = $this->input->post('user_name');
                    $user_password = md5($this->input->post('user_password'));
        
                    if ($this->auth_model->validate_user($user_name, $user_password) == true) 
                    {
                        $this->session->set_flashdata('success', 'Welcome back '.$first_name.'');
                        redirect('admin/schools');
                    } else 
                    {   
            //3. Condition of validation rules failed
                        $this->session->set_flashdata('error', 'Incorrect details, please try again');
                    }
                }
                 $V_data['title'] = 'Admin Login';
                 $data = array
                 (
                    "title" => "Admin Login",
                    "content" => $this->load->view("auth/layouts/login", $V_data, true),
                    "login" => true,
                );
                $this->load->view("auth/layouts/login_layout", $data);
    }
}
    
   

