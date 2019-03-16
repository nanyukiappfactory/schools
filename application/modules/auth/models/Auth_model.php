<?php

class Auth_model extends CI_Model 
{
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