<?php
class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('schools/all_schools');
    }
}