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
        // $this->load->library('googlemaps');
        $this->load->model("schools_model");
        $this->load->model("site_model");
        $this->load->model("file_model");
    }
    public function index($start = null)
        {
            $where = 'school_id > 0 AND deleted = 0 ';
            $table = 'school';
            
            //This is our Google API key. You will need to change this for your own website
            // $map_config['apikey'] = 'AIzaSyAMfrWKiELcjgQDzNq1n3LTVMSQAXGSs6E';
            // $map_config['center'] = '37.4419, -122.1419';
            // $map_config['zoom'] = 'auto';
            // // Initialize our map, passing in any map_config
            // $this->googlemaps->initialize($map_config);
            $order = 'school.school_name';
            $order_method = 'ASC';
             //pagination
            $segment = 5;
            $this->load->library('pagination');
            $config['base_url'] = site_url() . 'schools/all-schools/' . $order . '/' . $order_method;
            $config['total_rows'] = $this->site_model->count_items($table, $where);
            $config['uri_segment'] = $segment;
            $config['per_page'] = 2;
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
            $query = $this->schools_model->paginate_schools($table, $where, $start, $config["per_page"], $page, $order, $order_method);
            //change of order method
                    if ($order_method == 'DESC')
                    {
                        $order_method = 'ASC';
                    } else 
                    {
                        $order_method = 'DESC';
                    }
            $data['title'] = 'Schools';
            if (!empty($search_title) && $search_title != null) 
            {
                $data['title'] = 'school filtered by ' . $search_title;
            }
            $v_data["links"] = $this->pagination->create_links();
            $v_data['title'] = $data['title'];
            $v_data['order'] = $order;
            $v_data['order_method'] = $order_method;
            $v_data['query'] = $query;
            $v_data['page'] = $page;
            //$v_data['map'] = $this->googlemaps->create_map();
            $v_data['route'] = 'schools';
            $data = array(
                "title" => $this->site_model->display_page_title(),
                //'map' => $this->googlemaps->create_map(),
                "content" => $this->load->view("admin/school/all_schools", $v_data, true),
            );
            $this->load->view("admin/layouts/layout", $data);
        }
    public function search_schools()
        {
            $school_name = $this->input->post('search_param');
            $search_title = '';
            if (!empty($school_name))
             {
                $search_title .= ' school ID <strong>' . $school_name . '</strong>';
                $school_name = ' AND school.school_name = "' . $school_name . '"';
                $search = $school_name;
                $this->session->set_userdata('schools_search', $search);
                $this->session->set_userdata('schools_search_title', $search_title);
            }
             redirect("schools/all-schools");
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
                        redirect('schools/all-schools');
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
            redirect("schools/all-schools");
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
        redirect("schools/all-schools");
      }
    }
    public function export_schools()
    {
        $order = 'school.school_id';
        $order_method = 'DESC';
        $where = 'school_id > 0';
        $table = 'school';
        $schools_search = $this->session->userdata('school_search');
        $search_title = $this->session->userdata('school_search_title');

        if (!empty($schools_search) && $schools_search != null) 
        {
            $where .= $schools_search;
        }
        $title = 'Schools';

        if (!empty($search_title) && $search_title != null) 
        {
            $title = 'schools filtered by ' . $search_title;
        }

        if ($this->site_model->export_results($table, $where, $order, $order_method, $title))
         {
         } else
        {
            $this->session->set_userdata('error_message', "Unable to export results");
        }
    }
    public function import_schools()
    {

        // Check form submit or not
        if ($this->input->post('upload') != null)
         {
            $data = array();
            if (!empty($_FILES['file']['name']))
             {
                // Set preference
                $config['upload_path'] = $this->upload_csv_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // max_size in kb
                $config['file_name'] = $_FILES['file']['name'];
                // Load upload library
                $this->load->library('upload', $config);
                // File upload
                if ($this->upload->do_upload('file'))
                 {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    // Reading file
                    $file = fopen($this->upload_csv_path . '/' . $filename, "r");
                    $i = 0;
                    $importData_arr = array();
                    while (($filedata = fgetcsv($file, 1000, ",")) !== false) 
                    {
                        $num = count($filedata);
                        for ($c = 0; $c < $num; $c++) 
                        {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    $skip = 0;
                    // insert import data
                    foreach ($importData_arr as $schooldata) 
                    {
                        if ($this->schools_model->import_record($schooldata) != false)
                            {
                                $this->session->set_flashdata("success", 'Bulk import successfully');
                                redirect('schools/all-schools');
                           } else 
                            {
                                $this->session->set_flashdata("error", 'Unable to save bulk schools');
                                redirect('schools/all-schools');
                            }       
                        

                        $skip++;
                    }
                } else {
                    $this->session->set_flashdata("error", 'Failed to upload the file!!');
                    redirect('administration/partners');
                }
            } else {
                $this->session->set_flashdata("error", 'Failed to upload the file!!');
                redirect('administration/partners');
            }

        } else {
            $this->session->set_flashdata("error", 'File is required');
            redirect('administration/partners');
        }

    }
    
}
