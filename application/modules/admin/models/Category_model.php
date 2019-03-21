<?php
class Category_model extends CI_Model
{
    public function add_category()
    {
        // var_dump('am here');die();
        $data = array(
            "category_parent" => $this->input->post("category_parent"),
            "category_name" => $this->input->post("category_name"),
            "category_status" => 1,
        );
        if ($this->db->insert("category", $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function get_single_category($category_id)
    {
        $this->db->where("category_id", $category_id);
        return $this->db->get("category");
    }
    public function fetch_all_categories()
    {
        $this->db->select("category_parent");
        $this->db->from("category");
        return $this->db->get();
    }
    public function change_status($category_id, $new_category_status)
    {
        $this->db->set('category_status', $new_category_status);
        $this->db->where('category_id', $category_id);
        if ($this->db->update('category')) {
            return true;
        } else {
            return false;
        }
    }
}