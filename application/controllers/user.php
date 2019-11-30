<?php
class user extends CI_controller{

    public function register(){
        $data['title'] = 'Sign Up';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'matches[password]|required');
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');

        if($this->form_validation->run() === FALSE){

            $this->load->view('templates/loginheader');
            $this->load->view('user/register', $data);
            $this->load->view('templates/loginfooter');
            
        } 
        else {
            // Encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);

            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');

            redirect('user/login');
        }
    }

    public function login(){
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');

        if($this->form_validation->run() == FALSE){
            
            $this->load->view('templates/loginheader');
            $this->load->view('user/login', $data);
            $this->load->view('templates/loginfooter');
        } 
        else{
            $username = $this->input->post('username');
            
            $password = md5($this->input->post('password'));

            // Login user
            $user_id = $this->user_model->login($username, $password);
            $user_type =$this->user_model->getuser($user_id);
            

            if($user_id){
                $user_data = array(
                    'id' => $user_id,
                    'username' => $username,
                    'user_role'=> $user_type
                    // 'logged_in' => true
                );
              
                $this->session->set_userdata($user_data);
               
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect('posts/product');
            } else {

                $this->session->set_flashdata('login_failed', 'Login is invalid');
             
                redirect('user/login');
            }		
        }
    }

    public function logout(){
        // $this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');

        $this->session->sess_destroy();

        redirect('user/login','refresh');
    }


    //check username 
    public function check_username_exists($username = NULL){
        if ($username == NULL) {
            echo $this->user_model->check_username_exists($_POST['username']);
        }
        else {
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
            if($this->user_model->check_username_exists($username)){
                return true;
            } else {
                return false;
            }
        }
    }

	//check email
	public function check_email_exists($email = NULL){
        if ($email == NULL) {
            echo $this->user_model->check_email_exists($_POST['email']);
        }
        else {
            $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
            if($this->user_model->check_email_exists($email)){
                return true;
            } else {
                return false;
            }
        }
	}
}