<?php
class Site_model extends CI_Model
{

    public function display_page_title()
    {
        $page = explode("/", uri_string());
        $total = count($page);
        $last = $total - 1;
        $name = $this->site_model->decode_web_name($page[$last]);

        if (is_numeric($name)) {
            $last = $last - 1;
            $name = $this->site_model->decode_web_name($page[$last]);
        }
        $page_url = ucwords(strtolower($name));

        return $page_url;
    }

    public function decode_web_name($web_name)
    {
        // $field_name = str_replace("-", " ", $web_name);
        $field_name = preg_replace('/\s/', '-', $web_name);

        return $field_name;
    }

       
    public function count_items($table, $where, $limit = null)
    {
        if ($limit != null) 
        {
            $this->db->limit($limit);
        }
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->count_all_results();
    }
    public function get_categories($table, $where, $limit, $start, $order, $order_method)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_method);
        return $this->db->get();
    }

}