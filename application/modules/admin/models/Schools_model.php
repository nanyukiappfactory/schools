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
    
    public function paginate_schools($table, $where, $start, $limit, $page, $order, $order_method)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_method);
        return $this->db->get();
    }
    public function change_school_status($school_id, $new_school_status)
    {
        $this->db->set('school_status', $new_school_status);
        $this->db->where('school_id', $school_id);
        if ($this->db->update('school')) 
        {
            return true;
        } else 
        {
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
    public function get_images()
    {
        $this->db->select('school_images.*, school.school_id,school.school_name');
        $this->db->from('school_images');
        $this->db->join('school', 'school_images.school_id=school.school_id', 'left');
        return $this->db->get();
    }
    public function update_school($school_id, $file_name = false, $thumb_name = false)
    {
        $data = array(
            "school_name" => $this->input->post("school_name"),
            "school_write_up" => $this->input->post("school_write_up"),
            "school_zone" => $this->input->post("school_zone"),
            "school_boys_number" => $this->input->post("school_boys_number"),
            "school_girls_number" => $this->input->post("school_girls_number"),
            "school_location_name" => $this->input->post("school_location_name"),
            "school_latitude" => $this->input->post("school_latitude"),
            "school_longitude" => $this->input->post("school_longitude"),
            "school_status" => $this->input->post("school_status"),
        );

        if ($file_name != false) {
            $data["school_thumb_name"] = $thumb_name;
            $data["school_image_name"] = $file_name;
        }

        $this->db->set($data);
        $this->db->where('school_id', $school_id);
        if ($this->db->update('school')) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_school($school_id)
    {
        $data = array(
            'deleted' => 1,
            'deleted_by' => 1,
            'deleted_on' => date("Y-m-d H:i:s"),
        );
        $this->db->set($data);
        $this->db->where('school_id', $school_id);
        if ($this->db->update('school')) {
            return true;
        } else {
            return false;
        }
    }
    function import_record($record)
        {
            // echo json_encode($record);die();
          if(count($record) > 0)
          {
            // Check partner
            $this->db->select('*');
            $this->db->where('school_name', $record[1]);
            $q = $this->db->get('school');
            $response = $q->result_array();
            // Insert record
            if(count($response) == 0)
            {
              $newschool = array
              (
                "school_name" => trim($record[0]),
                "school_zone" => trim($record[1]),
                "school_latitude" => trim($record[2]),
                "school_longitude" => trim($record[3]),
                "school_location_name" => trim($record[4]),
                "school_girls_number" => trim($record[5]),
                "school_boys_number" => trim($record[6]),
                "school_write_up" => trim($record[7]),
                 );
              return $this->db->insert('school', $newschool);
            }
            else
            {
                return FALSE;
            }
       
          }
       
        }
      
    
}