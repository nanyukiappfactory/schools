<?php
if (!defined('BASEPATH')) 
{
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
        $v_data['pictures'] = $this->schools_model->get_images();
        $v_data['query'] = $query;
        $v_data['route'] = 'schools';
        $data = array
                    (
                    "title" => $this->site_model->display_page_title(),
                    "content" => $this->load->view("admin/school/all_schools", $v_data, true),
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
        if ($this->form_validation->run()) 
        {
             $resize = array
              (
                "width" => 600,
                "height" => 600,
              );

            if (isset($_FILES['school_image']) && $_FILES['school_image']['size'] > 0) 
            {
                $upload_response = $this->file_model->upload_image($this->upload_path, "school_image", $resize);
                    if ($upload_response['check'] == false)
                    {
                        $this->session->set_flashdata('error', $upload_response['message']);
                        redirect('schools/schools');
                    }  else
                    {
                        if ($this->schools_model->add_school($upload_response['file_name'], $upload_response['thumb_name']))
                         {
                            $this->session->set_flashdata('success', 'school Added successfully!!');
                            redirect('schools/all-schools');
                         } else
                         {
                            $this->session->flashdata("error", "Unable to add  school");
                         }
                    }
            } else 
            {
                if ($this->schools_model->add_school(null, null)) 
                {
                    $this->session->set_flashdata('success', 'school Added successfully!!');
                    redirect('schools/all-schools');
                } else 
                {
                    $this->session->flashdata("error", "Unable to add  school");
                }
            }
        } 
        else
        {
            if (!empty(validation_errors())) 
            {
                $this->session->set_flashdata("form_inputs", array(
                    'school_name' => $this->input->post('school_name'),
                    'school_boys_number' => $this->input->post('school_boys_number'),
                    'school_girls_number' => $this->input->post('school_girls_number'),
                    'school_location_name' => $this->input->post('school_location_name'),
                    'school_zone' => $this->input->post('school_zone'),
                    'school_latitude' => $this->input->post('school_latitude'),
                    'school_longitude' => $this->input->post('school_longitude'),
                    'school_write_up' => $this->input->post('school_write_up'),));
                $this->session->set_flashdata("error", validation_errors());
                redirect('schools/add-school');
            } 
        }
        $v_data['title'] = "add school";
        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("admin/school/add_school", $v_data, true)
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
        if ($this->form_validation->run()) 
        {
            $resize = array
                (
                    "width" => 600,
                    "height" => 600,
                );
            if (isset($_FILES['school_image']) && $_FILES['school_image']['size'] > 0)
             {
                $upload_response = $this->file_model->upload_image($this->upload_path, "school_image", $resize);
                if ($upload_response['check'] == false) 
                {
                    $this->session->set_flashdata('error', $upload_response['message']);
                } else
                {
                    if ($this->schools_model->update_school($school_id, $upload_response['file_name'], $upload_response['thumb_name'])) 
                    {
                        $this->session->set_flashdata('success', 'school updated successfully!!');
                    } else
                    {
                        $this->session->flashdata("error_message", "Unable to update  school");
                    }
                }
            } else
            {
                if ($this->schools_model->update_school($school_id))
                {
                    $this->session->set_flashdata('success', 'school updated successfully!!');
                } else
                {
                    $this->session->flashdata("error", "Unable to update  school");
                }
            }
        }
         $query = $this->schools_model->get_single_school($school_id);
        if ($query->num_rows() > 0) 
        {
            $row = $query->row();
            $school = $row->school_id;
            $v_data["query"] = $query;
            $v_data["school_id"] = $school;
            $v_data['schools'] = $this->schools_model->get_all_schools();
            $data = array("title" => $this->site_model->display_page_title(),
                  "content" => $this->load->view("admin/school/edit_school", $v_data, true));
            $this->load->view("admin/layouts/layout", $data);

        } else 
        {
            $this->session->set_flashdata("error", "Unable to update  school");
            redirect("schools/schools");
        }

    }
    public function deactivate_school($school_id, $status_id)
    {
        if ($status_id == 1)
         {
            $new_school_status = 0;
            $message = 'Deactivated';
         } else 
         {
            $new_school_status = 1;
            $message = 'Activated';
        }
           $result = $this->schools_model->change_school_status($school_id, $new_school_status);
        if ($result == true) 
        {
            $this->session->set_flashdata('success', "school ID: " . $school_id . " " . $message . " successfully!");
        } else 
        {
            $this->session->set_flashdata('error', "school ID: " . $school_id . " failed to " . $message);
        }

        redirect('schools/all-schools');
    }
    public function delete_school($school_id)
    {
        if ($this->schools_model->delete_school($school_id))
        {
            $this->session->set_flashdata('success', 'Deleted successfully');
            redirect('schools/all-schools');
        } else 
        {
            $this->session->set_flashdata('error', 'Unable to delete, Try again!!');
            redirect('schools/all-schools');
        }
    }
    public function view_school($school_id)
    {
        $query = $this->schools_model->get_single_school($school_id);
        if($query->num_rows()>0)
         {
            $row = $query->row();
            $school = $row->school_id;
            $v_data["query"] = $query;
            $v_data["school_id"] = $school;
            $v_data['schools'] = $this->schools_model->get_all_schools();
            $v_data['pictures'] = $this->schools_model->get_images();
            //echo json_encode($v_data['pictures']->result());die();
            $data = array(
                    "title" => $this->site_model->display_page_title(),
                    "content" => $this->load->view("admin/school/view_school", $v_data, true));
            $this->load->view("admin/layouts/layout", $data);
        } else
      {
        $this->session->set_flashdata("error","could not find your school");
        redirect("schools/schools");
      }
    }
    
}
