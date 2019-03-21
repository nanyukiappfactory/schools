<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once "./application/modules/admin/controllers/Admin.php";

class School extends Admin
{
    public $upload_path;
    public $upload_location;

    public function __construct()
    {
        parent::__construct();
        $this->upload_path = realpath(APPPATH . '../assets/uploads');
        //get the location to upload images
        $this->upload_location = base_url() . 'assets/uploads';
        $this->load->library("image_lib");
        //$this->load->library('googlemaps');
        $this->load->model("schools_model");
        $this->load->model("site_model");
        $this->load->model("file_model");
    }
    public function index()
    {
        $query = $this->schools_model->get_all_schools();
        //echo json_encode($query->result());die();
        $v_data['query'] = $query;
        //$v_data['other_images'] = ($this->schools_model->get_other_images());
        $v_data['route'] = 'schools';
        $data = array
            (
            "title" => $this->site_model->display_page_title(),
            // 'map' => $this->googlemaps->create_map(),
            "content" => $this->load->view("admin/all_schools", $v_data, true),
        );
        $this->load->view("layouts/layout", $data);
    }
    public function add_school()
    {
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
                    redirect('school/schools');
                } else {
                    if ($this->schools_model->add_school($upload_response['file_name'], $upload_response['thumb_name'])) {
                        $this->session->set_flashdata('success', 'school Added successfully!!');
                        redirect('school/all-schools');
                    } else {
                        $this->session->flashdata("error_message", "Unable to add  school");
                    }
                }
            } else {
                if ($this->schools_model->add_school(null, null)) {
                    $this->session->set_flashdata('success', 'school Added successfully!!');
                    redirect('school/all-schools');
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
                redirect('school/add-school');
            }
        }
        $v_data['title'] = "add school";
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/add_school", $v_data, true),
        );
        $this->load->view("admin/layouts/layout", $data);
    }

}