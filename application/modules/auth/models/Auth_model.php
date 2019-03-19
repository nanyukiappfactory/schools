<?php
if (!defined('BASEPATH')) { exit('No direct access script allowed'); }

class Auth_model extends CI_Model 
{
	public function validate_user($user_name, $user_password)
	{
		if($user_name == "admin" && $user_password == md5(123456))
		{
			$newdata = array(
				'user_name' => '$user_name',
				'login_status' => true,
				'$first_name' => 'Patricia',
			);
			$this->session->set_userdata('login_status', $newdata);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function check_login()
	{
		if($this->session->userdata('login_status'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?>
