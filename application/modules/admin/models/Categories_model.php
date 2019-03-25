<?php
class Categories_model extends CI_Model
{
    public function add_category()
    {
        $data = array(
            "category_parent" => $this->input->post("category_parent"),
            "category_name" => $this->input->post("category_name"),
            "category_status" => 1,
        );
        if ($this->db->insert("category", $data)) 
        {
            return $this->db->insert_id();
        } 
        else 
        {
            return false;
        }
    }

    public function get_single_category($category_id)
    {
        $this->db->where("category_id", $category_id);
        return $this->db->get("category");
    }

    public function get_category_parents()
    {
        $this->db->select('*');
        $this->db->from("category");
        $this->db->distinct();
        return $this->db->get();
    } 
}