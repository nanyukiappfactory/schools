<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Categories extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/categories_model");
        $this->load->model("admin/site_model");
    }
    public function index($order = 'category.category_name', $order_method = 'ASC')
    {
        $where = 'category_id > 0 AND deleted=0';
        $table = 'category';

        //pagination
        $segment = 5;
        $config['base_url'] = site_url() . 'categories/all-categories/' . $order . '/' . $order_method;
        $config['total_rows'] = $this->site_model->count_items($table, $where);
        $config['uri_segment'] = $segment;
        $config['per_page'] = 4;
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

        $query = $this->site_model->get_categories($table, $where, $config["per_page"], $page, $order, $order_method);
        if ($order_method == 'DESC') 
        {
            $order_method = 'ASC';
        }
        else 
        {
            $order_method = 'DESC';
        }
        $data['title'] = 'Categories';
        if (!empty($search_title) && $search_title != null) {
            $data['title'] = 'Categories filtered by ' . $search_title;
        }
        $v_data['title'] = $data['title'];
        $v_data['order'] = $order;
        $v_data['order_method'] = $order_method;
        $v_data['query'] = $query;
        $v_data['page'] = $page;

        $data['content'] = $this->load->view('category/all_categories', $v_data, true);
        $this->load->view("admin/layouts/layout", $data);
    }

    public function add_category()
    {
        $this->form_validation->set_rules("category_parent", "category_parent");
        $this->form_validation->set_rules("category_name", "category_name", "required|is_unique[category.category_name]");

        if ($this->form_validation->run()) 
        {
            $category_id = $this->categories_model->add_category();
            if ($category_id > 0)
            {
                $this->session->set_flashdata("success", "New category ID" . $category_id . " has been added");
                redirect("categories/all-categories");
            }
             else 
            {
                $this->session->set_flashdata("error", "unable to add category");
            }
        }
        $query = $this->site_model->get_categories($table = 'category', $where = 'deleted != 1', null, null, $order = 'category_name', $order_method = 'ASC');
        $v_data['query'] = $query;
        $v_data['title'] = "Add Category";
        $data = array(
            "content" => $this->load->view("categories/add_category", $v_data, true),
        );
        $this->load->view("admin/layouts/layout", $data);
    }
    public function deactivate_category($category_id, $status_id)
    {
        if ($status_id == 1) 
        {
            $new_category_status = 0;
            $message = 'Deactivated';
        }
         else 
        {
            $new_category_status = 1;
            $message = 'Activated';
        }
        $result = $this->categories_model->change_status($category_id, $new_category_status);
        if ($result == true)
         {
            $this->session->set_flashdata('success', "Category ID: " . $category_id . " " . $message . " successfully!");
        } 
        else
        {
            $this->session->set_flashdata('error', "Category ID: " . $category_id . " failed to " . $message);
        }
        redirect("categories/all-categories");
    }
    public function delete_category($category_id)
    {
        if ($this->categories_model->delete_category($category_id)) 
        {
            $this->session->set_flashdata('success', 'Deleted successfully');
            redirect("categories/all-categories");
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Unable to delete, Try again!!');
            redirect("categories/all-categories");
        }
    }
    public function edit_category($category_id)
    {
        $this->form_validation->set_rules("category_name", "Category Name", "required|is_unique[category.category_name]");
        if ($this->form_validation->run()) 
        {
            $update_status = $this->categories_model->update_category($category_id);
            if ($update_status) 
            {
                $this->session->set_flashdata("success", "New category ID" . $category_id . " has been added");
                redirect("categories/all-categories");
            }
        }
         else 
         {
            $my_category = $this->categories_model->get_single_category($category_id);
            if ($my_category->num_rows() > 0)
             {
                $row = $my_category->row();
                $category_parent = $row->category_parent;
                $category_name = $row->category_name;
                $v_data["category_id"] = $category_id;
                $v_data["category_name"] = $category_name;
                $v_data['categories'] = $this->categories_model->get_category_parents();
                $v_data["category_parent"] = $category_parent;
                $data = array("title" => $this->site_model->display_page_title(),
                    "content" => $this->load->view("category/edit_category", $v_data, true));

                $this->load->view("admin/layouts/layout", $data);
            } 
            else 
                {
                    $this->session->set_flashdata("error", "Unable to update  school");
                    redirect("categories/all-categories");
                }
        }
    }
    function search()
    {
        $v_data['query'] = $this->categories_model->get_search($table = 'category', $where = 'deleted != 1', null, null, $v_data['order'] = 'category_name',
        $v_data["links"] = $this->pagination->create_links(),
        $v_data['order_method'] = 'ASC');
        
        $data = array
        (
            "content" => $this->load->view("category/all_categories", $v_data, true),
        );
        $this->session->set_userdata('categories_search', $data);
        
        $this->load->view("admin/layouts/layout", $data);
    }

    public function search_categories()
    {
        $category_parent = $this->input->post('search_param');
        $search_title = '';
        if (!empty($category_parent)) 
        {
            $search_title .= ' Searched: <strong>' . $category_parent . '</strong>';
            $category_parent = ' AND category.category_parent = "' . $category_parent . '"';
        }
        $search = $category_parent;
        $this->session->set_userdata('categories_search', $search);
        $this->session->set_userdata('categories_search_title', $search_title);
        redirect("categories/all-categories");
    }

    public function close_search()
    {
        $this->session->unset_userdata('categories_search');
        $this->session->set_flashdata("success_message", "Search has been closed");
        redirect("categories/all-categories");
    }
    public function export_categories()
    {
        $order = 'category.created_on';
        $order_method = 'DESC';
        $where = 'category_id > 0';
        $table = 'category';
        $categories_search = $this->session->userdata('categories_search');
        $search_title = $this->session->userdata('categories_search_title');

        if (!empty($categories_search) && $categories_search != null) {
            $where .= $categories_search;
        }
        $title = 'categories';
        if (!empty($search_title) && $search_title != null) {
            $title = 'Categories filtered by ' . $search_title;
        }

        if ($this->site_model->export_results($table, $where, $order, $order_method, $title)) {
        } else {
            $this->session->set_userdata('error_message', "Unable to export results");
        }

    }
    public function import_categories()
    {
        // Check form submit or not
        if ($this->input->post('upload') != null) {
            $data = array();
            if (!empty($_FILES['file']['name'])) {
                // Set preference
                $config['upload_path'] = $this->upload_csv_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // max_size in kb
                $config['file_name'] = $_FILES['file']['name'];
                // Load upload library
                $this->load->library('upload', $config);
                // File upload
                if ($this->upload->do_upload('file')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    // Reading file
                    $file = fopen($this->upload_csv_path . '/' . $filename, "r");
                    $i = 0;

                    $importData_arr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                        $num = count($filedata);

                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    $skip = 0;
                    // insert import data
                    foreach ($importData_arr as $categorydata) 
                    {
                            if ($this->partners_model->import_record($categorydata) != false) {
                                $this->session->set_flashdata("success", 'Bulk import successfully');
                                redirect("categories/all-categories");
                            } else {
                                $this->session->set_flashdata("error", 'Unable to save bulk partners');
                                redirect("categories/all-categories");
                            }
                        $skip++;
                    }
                } else {
                    $this->session->set_flashdata("error", 'Failed to upload the file!!');
                    redirect("categories/all-categories");
                }
            } else {
                $this->session->set_flashdata("error", 'Failed to upload the file!!');
                redirect("categories/all-categories");
            }
        } else {
            $this->session->set_flashdata("error", 'File is required');
            redirect("categories/all-categories");
        }

    }
}