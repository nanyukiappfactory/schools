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
<<<<<<< HEAD
         //echo json_encode($query->result());die();
         $v_data['pictures'] = $this->schools_model->get_images();
=======
        //echo json_encode($query->result());die();
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
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
<<<<<<< HEAD


    public function add_school()
    {
         // This is our Google API key. You will need to change this for your own website
        // $map_config['apikey'] = 'AIzaSyAMfrWKiELcjgQDzNq1n3LTVMSQAXGSs6E';
        // $map_config['center'] = '37.4419, -122.1419';
        // $map_config['zoom'] = 'auto';
        // Initialize our map, passing in any map_config
        //$this->googlemaps->initialize($map_config);
=======
    public function add_school()
    {
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
        $this->form_validation->set_rules("school_name", "School Name", "required");
        $this->form_validation->set_rules("school_write_up", "school Write Up", "required");
        $this->form_validation->set_rules("school_boys_number", "Number of Boys", "required");
        $this->form_validation->set_rules("school_girls_number", "Number of Girls", "required");
        $this->form_validation->set_rules("school_location_name", "Location", "required");
        $this->form_validation->set_rules("school_zone", "School Zone", "required");
        $this->form_validation->set_rules("school_latitude", "Latitude", "required");
        $this->form_validation->set_rules("school_longitude", "Longitude", "required");
        $form_errors = "";
<<<<<<< HEAD
        if ($this->form_validation->run()) 
        {
=======
        if ($this->form_validation->run()) {
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1

            $resize = array(
                "width" => 600,
                "height" => 600,
            );
<<<<<<< HEAD

            if (isset($_FILES['school_image']) && $_FILES['school_image']['size'] > 0) 
            {
                $upload_response = $this->file_model->upload_image($this->upload_path, "school_image", $resize);
                if ($upload_response['check'] == false)
                {
=======
            if (isset($_FILES['school_image']) && $_FILES['school_image']['size'] > 0) {
                $upload_response = $this->file_model->upload_image($this->upload_path, "school_image", $resize);
                if ($upload_response['check'] == false) {
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
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
<<<<<<< HEAD

            } 
            else 
            {
                if ($this->schools_model->add_school(null, null)) 
                {
                    $this->session->set_flashdata('success', 'school Added successfully!!');
                    redirect('school/all-schools');
                } else 
                {
=======
            } else {
                if ($this->schools_model->add_school(null, null)) {
                    $this->session->set_flashdata('success', 'school Added successfully!!');
                    redirect('school/all-schools');
                } else {
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
                    $this->session->flashdata("error", "Unable to add  school");
                }
            }
<<<<<<< HEAD

        } else
         {
            if (!empty(validation_errors())) 
            {
=======
        } else {
            if (!empty(validation_errors())) {
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
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
<<<<<<< HEAD
            } 
        }
        $v_data['title'] = "add school";
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/add_school", $v_data, true),
        );
        $this->load->view("admin/layouts/layout", $data);
    }

    public function edit_school($school_id)
    {

        $this->form_validation->set_rules("school_name", "School Name", "required");
        $this->form_validation->set_rules("school_write_up", "school Write Up", "required");
        $this->form_validation->set_rules("school_boys_number", "Number of Boys", "required");
        $this->form_validation->set_rules("school_girls_number", "Number of Girls", "required");
        $this->form_validation->set_rules("school_zone", "School Zone", "required");
        $this->form_validation->set_rules("school_location_name", "Location", "required");
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
                // var_dump($upload_response);die();
                if ($upload_response['check'] == false) {
                    $this->session->set_flashdata('error', $upload_response['message']);
                } else {
                    if ($this->schools_model->update_school($school_id, $upload_response['file_name'], $upload_response['thumb_name'])) {
                        $this->session->set_flashdata('success', 'school updated successfully!!');
                    } else {
                        $this->session->flashdata("error_message", "Unable to update  school");
                    }
                }
            } else {
                if ($this->schools_model->update_school($school_id)) {
                    $this->session->set_flashdata('success', 'school updated successfully!!');
                } else {
                    $this->session->flashdata("error", "Unable to update  school");
                }

            }

        }
        $query = $this->schools_model->get_single_school($school_id);
// echo json_encode($query->result());die();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $school = $row->school_id;
            $v_data["query"] = $query;
            $v_data["school_id"] = $school;
            $v_data['schools'] = $this->schools_model->get_all_schools();
            $data = array("title" => $this->site_model->display_page_title(),
                "content" => $this->load->view("admin/edit_school", $v_data, true));

            $this->load->view("admin/layouts/layout", $data);

        } else {
            $this->session->set_flashdata("error", "Unable to update  school");
            redirect("school/schools");
        }

=======
            }
        }
        $v_data['title'] = "add school";
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/add_school", $v_data, true),
        );
        $this->load->view("admin/layouts/layout", $data);
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
    }
    public function deactivate_school($school_id, $status_id)
    {
        if ($status_id == 1) {
            $new_school_status = 0;
            $message = 'Deactivated';
        } else {
            $new_school_status = 1;
            $message = 'Activated';
        }

<<<<<<< HEAD
        $result = $this->schools_model->change_school_status($school_id, $new_school_status);
        if ($result == true) {
  
            $this->session->set_flashdata('success', "school ID: " . $school_id . " " . $message . " successfully!");
        } else {
            $this->session->set_flashdata('error', "school ID: " . $school_id . " failed to " . $message);
        }

        redirect('school/all-schools');
    }
    public function delete_school($school_id)
    {
        if ($this->schools_model->delete_school($school_id))
        {
            $this->session->set_flashdata('success', 'Deleted successfully');
            redirect('school/all-schools');
        } else 
        {
            $this->session->set_flashdata('error', 'Unable to delete, Try again!!');
            redirect('school/all-schools');
        }
    }


  }  
=======
}
>>>>>>> d82af86557822bdfc707bded61376709db1b15d1
