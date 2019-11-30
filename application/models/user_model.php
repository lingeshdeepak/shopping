<?php
	class user_model extends CI_model{

	public function getuser($user_id){
		
		$result=$this->db->get('user',$user_id);

		if($result->num_rows() == 1){
			return $result->row()->user_role;
		} 
		else {
			return false;
		}
	}


	public function register($enc_password){

		$data = array('name' => $this->input->post('name'),
		'email' => $this->input->post('email'),
		'username' => $this->input->post('username'),
		'password' => $enc_password,
		'user_role'=>2);

		return $this->db->insert('user', $data);
	}

	public function login($username, $password){

	
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('user');

		if($result->num_rows() == 1){
			return $result->row(0)->id;
		} 
		else {
			return false;
		}
	}

	public function check_username_exists($username){
		$query = $this->db->get_where('user', array('username' => $username));
		if(empty($query->row_array())){
			return true;
		} else {
			return false;
		}
	}

	// Check email exists
	public function check_email_exists($email){
		$query = $this->db->get_where('user', array('email' => $email));
		if(empty($query->row_array())){
			return true;
		} else {
			return false;
		}
	}
}