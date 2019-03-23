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

    public function fetch_all_categories()
    {
        $this->db->select("category_parent");
        $this->db->from("category");
        return $this->db->get();
    }

    public function get_category_parents()
    {
        $this->db->select('*');
        $this->db->from("category");
        $this->db->distinct();
        return $this->db->get();
    }

    public function get_search() {
        $match = $this->input->post('search');
        $this->db->like('category_name',$match);
        $this->db->or_like('category_parent',$match);
        $this->db->or_like('category_id',$match);
        $query = $this->db->get('category');
        return $query;
    }

    public function change_status($category_id, $new_category_status)
    {
        $this->db->set('category_status', $new_category_status);
        $this->db->where('category_id', $category_id);
        if ($this->db->update('category')) 
        {
            return true;
        }
         else
        {
            return false;
        }
    }

    public function delete_category($category_id)
    {
        $data = array(
            'deleted' => 1,
            'deleted_by' => 1,
            'deleted_on' => date("Y-m-d H:i:s"),
        );

        $this->db->set($data);
        $this->db->where('category_id', $category_id);
        if ($this->db->update('category'))
        {
            return true;
        }
         else
        {
            return false;
        }
    }

     public function update_category($category_id)
    {
        $data = array(
            "category_parent" => $this->input->post("category_parent"),
            "category_name" => $this->input->post("category_name"),
        );
        $this->db->set($data);
        $this->db->where('category_id', $category_id);

        if ($this->db->update('category')) {
            return true;
        } else {
            return false;
        }

    }
    function import_record($record)
        {
          if(count($record) > 0){
            
            $this->db->select('*');
            $this->db->where('category_name', $record[1]);
            $q = $this->db->get('category');
            $response = $q->result_array();
       
            // Insert record
            if(count($response) == 0){
              $newcategory = array(
                "category_id" => trim($record[0]),
                "category_name" => trim($record[1]),
                "category_parent" => trim($record[2]),
               
              );
              return $this->db->insert('category', $newcategory);
            }
            else
            {
                return FALSE;
            }
       
          }
       
        }
}