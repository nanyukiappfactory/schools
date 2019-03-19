<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/admin/controllers/Admin.php";

class School extends Admin
{
    function __construct()
    {
        parent :: __construct();
        
    }
    <?php if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }
    
    class Schools extends MX_Controller
    {
        public $upload_path;
        public $upload_location;
    
        public function __construct()
        {
            parent::__construct();
            $this->upload_path = realpath(APPPATH . '../assets/uploads');
    
            //get the location to upload images
            $this->upload_location = base_url() . 'assets/uploads';
    
            $this->load->model("laikipiaschools/schools_model");
            $this->load->library("image_lib");
            $this->load->library('googlemaps');
            $this->load->library('ckeditor');
            $this->load->library('image_CRUD');
    
            $this->load->library('ckfinder');
            $this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
            $this->ckeditor->config['language'] = 'en';
            $this->ckeditor->config['width'] = '730px';
            $this->ckeditor->config['height'] = '300px';
            //Add Ckfinder to Ckeditor
            $this->ckfinder->SetupCKEditor($this->ckeditor, '../asset/ckfinder/');
    
            $this->load->model("laikipiaschools/schools_model");
            $this->load->model("laikipiaschools/site_model");
            $this->load->model("laikipiaschools/file_model");
    
        }
        
        public function index($start = null)
        {
            $where = 'school_id > 0 AND deleted = 0 ';
            $table = 'school';
            $school_search = $this->session->userdata('schools_search');
            $search_title = $this->session->userdata('schools_search_title');
    
            if (!empty($school_search) && $school_search != null) {
                $where .= $school_search;
                // var_dump($where);die();
            }
    
            // This is our Google API key. You will need to change this for your own website
            $map_config['apikey'] = 'AIzaSyAMfrWKiELcjgQDzNq1n3LTVMSQAXGSs6E';
            $map_config['center'] = '37.4419, -122.1419';
            $map_config['zoom'] = 'auto';
            // Initialize our map, passing in any map_config
            $this->googlemaps->initialize($map_config);
    
            $order = 'school.school_name';
            $order_method = 'ASC';
            $this->form_validation->set_rules("school_name", "School Name", "required");
            $this->form_validation->set_rules("school_write_up", "school Write Up", "required");
            $this->form_validation->set_rules("school_boys_number", "Number of Boys", "required");
            $this->form_validation->set_rules("school_girls_number", "Number of Girls", "required");
            $this->form_validation->set_rules("school_location_name", "Location", "required");
            $this->form_validation->set_rules("school_zone", "School Zone", "required");
            $this->form_validation->set_rules("school_latitude", "Latitude", "required");
            $this->form_validation->set_rules("school_longitude", "Longitude", "required");
    
            $form_errors = "";
            if ($this->form_validation->run()) {
    
                $resize = array(
                    "width" => 600,
                    "height" => 600,
                );
    
                if (isset($_FILES['school_image']) && $_FILES['school_image']['size'] > 0) {
                    $upload_response = $this->file_model->upload_image($this->upload_path, "school_image", $resize);
                    if ($upload_response['check'] == false) {
                        $this->session->set_flashdata('error', $upload_response['message']);
                        redirect('laikipiaschools/schools');
                    } else {
                        if ($this->schools_model->add_school($upload_response['file_name'], $upload_response['thumb_name'])) {
                            $this->session->set_flashdata('success', 'school Added successfully!!');
                            redirect('laikipiaschools/schools');
                        } else {
                            $this->session->flashdata("error_message", "Unable to add  school");
                        }
                    }
    
                } else {
                    if ($this->schools_model->add_school(null, null)) {
                        $this->session->set_flashdata('success', 'school Added successfully!!');
                        redirect('laikipiaschools/schools');
                    } else {
                        $this->session->flashdata("error", "Unable to add  school");
                    }
    
                }
    
            } else {
                if (!empty(validation_errors())) {
                    $this->session->set_flashdata("form_inputs", array(
                        'school_name' => $this->input->post('school_name'),
                        'school_boys_number' => $this->input->post('school_boys_number'),
                        'school_girls_number' => $this->input->post('school_girls_number'),
                        'school_location_name' => $this->input->post('school_location_name'),
                        'school_zone' => $this->input->post('school_zone'),
                        'school_latitude' => $this->input->post('school_latitude'),
                        'school_longitude' => $this->input->post('school_longitude'),
                        'school_write_up' => $this->input->post('school_write_up'),
                    ));
                    $this->session->set_flashdata("error", validation_errors());
                    redirect('administration/add-school');
                } else {
                    //pagination
                    $segment = 5;
                    $this->load->library('pagination');
                    $config['base_url'] = site_url() . 'administration/schools/' . $order . '/' . $order_method;
                    $config['total_rows'] = $this->site_model->count_items($table, $where);
                    // $config["total_rows"] = $this->friends_model->countAll();
                    $config['uri_segment'] = $segment;
                    $config['per_page'] = 20;
                    $config['num_links'] = 5;
                    $config['full_tag_open'] = '<div class="pagging text-center"><nav aria-label="Page navigation example"><ul class="pagination">';
                    $config['full_tag_close'] = '</ul></nav></div>';
                    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
                    $config['num_tag_close'] = '</span></li>';
                    $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
                    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
                    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
                    $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
                    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
                    $config['prev_tagl_close'] = '</span></li>';
                    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
                    $config['first_tagl_close'] = '</span></li>';
                    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
                    $config['last_tagl_close'] = '</span></li>';
    
                    $this->pagination->initialize($config);
                    $page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
                    $v_data["links"] = $this->pagination->create_links();
                    $query = $this->schools_model->get_all_schools($table, $where, $start, $config["per_page"], $page, $order, $order_method);
    
                    //change of order method
                    if ($order_method == 'DESC') {
                        $order_method = 'ASC';
                    } else {
                        $order_method = 'DESC';
                    }
    
                    $data['title'] = 'Lakipia Schools';
    
                    if (!empty($search_title) && $search_title != null) {
                        $data['title'] = 'school filtered by ' . $search_title;
                    }
                    $v_data['title'] = $data['title'];
    
                    $v_data['order'] = $order;
                    $v_data['order_method'] = $order_method;
                    $v_data['query'] = $query;
                    $v_data['other_images'] = ($this->schools_model->get_other_images());
                    $v_data['categories'] = $this->site_model->get_all_categories();
                    $v_data['pictures'] = $this->schools_model->get_images();
                    $v_data['page'] = $page;
                    $v_data['schools'] = $this->schools_model->get_all_schools($table, $where, $start, $config["per_page"], $page, $order, $order_method);
                    $v_data['map'] = $this->googlemaps->create_map();
                    $school_array = array();
                    // echo json_encode($v_data['pictures']->result());die();
                    foreach ($v_data["schools"]->result() as $school) {
                        array_push($school_array, array(
                            'id' => $school->school_id,
                            'name' => $school->school_name,
                        ));
                    }
    
                    $v_data['search_options'] = $school_array;
                    $v_data['route'] = 'schools';
                    $data = array(
                        "title" => $this->site_model->display_page_title(),
                        'map' => $this->googlemaps->create_map(),
                        "content" => $this->load->view("schools/all_schools", $v_data, true),
                    );
                    // $v_data["all_schools"] = $this->schools_model->get_all_schools();
    
                    $this->load->view("laikipiaschools/layouts/layout", $data);
                }
            }
    
        }
        public function add_school()
        {
            $this->form_validation->set_rules("school_name", "School Name", "required");
            $this->form_validation->set_rules("school_write_up", "school Write Up", "required");
            $this->form_validation->set_rules("school_boys_number", "Number of Boys", "required");
            $this->form_validation->set_rules("school_girls_number", "Number of Girls", "required");
            $this->form_validation->set_rules("school_location_name", "Location", "required");
            $this->form_validation->set_rules("school_zone", "School Zone", "school_zone");
            $this->form_validation->set_rules("school_latitude", "Latitude", "required");
            $this->form_validation->set_rules("school_longitude", "Longitude", "required");
            $this->form_validation->set_rules("school_status", "Status", "required");
    
            //  validate
            $form_errors = "";
    
            if ($this->form_validation->run()) {
                if ($upload_response['check'] == false) {
                    $this->session->set_flashdata('error', $upload_response['message']);
                } else {
                    if ($this->schools_model->add_school($upload_response['file_name'], $upload_response['thumb_name'])) {
                        $this->session->set_flashdata('success', 'School Added successfully!!');
                        redirect('laikipiaschools/add_school');
                    } else {
                        $this->session->flashdata("error_message", "Unable to add  school");
                    }
    
                }
                $school_id = $this->schools_model->add_school();
                if ($school_id > 0) {
                    $this->session->flashdata("success_message", "New school ID" . $school_id . "has been added");
    
                    redirect("laikipiaschools/add_school");
                } else {
                    $this->session->flashdata("error_message", "Unable to add  school");
                }
            }
            $v_data['title'] = "add school";
            $data = array(
                "title" => $this->site_model->display_page_title(),
                "content" => $this->load->view("schools/add_school", $v_data, true),
            );
            // var_dump($data);die();
            // $this->load->view("schools/add_school", $data);
    
            $this->load->view("laikipiaschools/layouts/layout", $data);
        }

    // public function index()
    // {  
        
        
    //     $V_data['title'] = 'Admin Login';
    //         $data = array
    //             (
    //             "title" => "School Admin",
    //             "content" => $this->load->view("admin/all_schools", $V_data, true),
    //             "login" => true,
    //         );
    //     $this->load->view("admin/layouts/layout", $data);
    // }
}

?>
