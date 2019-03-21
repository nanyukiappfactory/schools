<?php
class Schools_model extends CI_Model
{
public function add_school($file_name, $thumb_name)
    {
        // create an array of The data to save
        $data = array(
            "school_name" => $this->input->post("school_name"),
            "school_write_up" => $this->input->post("school_write_up"),
            "school_boys_number" => $this->input->post("school_boys_number"),
            "school_girls_number" => $this->input->post("school_girls_number"),
            "school_latitude" => $this->input->post("school_latitude"),
            "school_longitude" => $this->input->post("school_longitude"),
            "school_location_name" => $this->input->post("school_location_name"),
            "school_zone" => $this->input->post("school_zone"),
            "school_image_name" => $file_name,
            "school_thumb_name" => $thumb_name,
            'school_status' => 1,

        );

        if ($this->db->insert("school", $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function get_all_schools()
    {
    
        $this->db->select("*");
        $this->db->from('school');
        return $this->db->get();

    }
    public function get_single_school($school_id)
    {
        $this->db->where("school_id", $school_id);
        return $this->db->get("school");
    }
}