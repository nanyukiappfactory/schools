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
    public function export_results($table, $where, $order, $order_method, $title)
	{
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get();

		$delimiter = ",";
        $newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		$res = force_download(date("Y-m-d H:i:s").$title.'.csv', $data);
		if($res)
		{
			return TRUE;
		}

		else
		{
			return FALSE;
		}
	}

	public function exports_data($data, $title)
	{
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=\"".$title."".".csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");

		$handle = fopen('php://output', 'w');

		foreach ($data as $row) {
			fputcsv($handle, $row);
		}
		fclose($handle);
		exit;
	}
}