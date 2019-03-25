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
                if (!empty(validation_errors())) 
                {
                    $this->session->set_flashdata("form_inputs", array(
                        'category_name' => $this->input->post('category_name'),
                        'category_parent' => $this->input->post('category_parent'),
                    ));
                    $this->session->set_flashdata("error", validation_errors());
                    redirect("categories/all-categories");            
                } 
            }
        }
        $query = $this->site_model->get_categories($table = 'category', $where = 'deleted != 1', null, null, $order = 'category_name', $order_method = 'ASC');
        $v_data['query'] = $query;
        $v_data['title'] = "Add Category";
        $data = array(
            "content" => $this->load->view("category/add_category", $v_data, true),
        );
        $this->load->view("admin/layouts/layout", $data);
    }
}