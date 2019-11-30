<?php
class comments extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
    }

    public function createComment()
    {
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('body','body','required');

        $id = $this->input->post('productId');
        $user_id = $this->session->userdata('id'); // userdata('id')=> this id is present in db.
        
        if($this->form_validation->run() == FALSE){            
            $data['post'] = $this->posts_model->get_product($id);
            $data['comments'] = $this->comment_model->getCommentDetails($id);

            
            $this->load->view('templates/header');
            $this->load->view('posts/viewdetails',$data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->comment_model->createComment($user_id);
      
            $this->session->set_flashdata('comment_created','Comment created successfully!');
               
        }
         redirect('posts/viewdetails/'.$id);
             
           
    }

    public function editComment($id) {
  
        $data['post'] = $this->comment_model->getComment($id);

        $this->load->view('templates/header');
        $this->load->view('posts/editComment',$data);
        $this->load->view('templates/footer');
    
        
    }

    public function updateComment() {
        $productId = $this->input->post('productId');

        $this->comment_model->updateComment();

        $this->session->set_flashdata('comment_updated','Comment has been updated!');
        redirect('posts/viewdetails/'.$productId);
    }

    public function deleteComment($id) {
        $productId = $this->uri->segment(4,0);
        $commentId = $this->uri->segment(3,0);
        
        $this->comment_model->deleteComment($commentId);

        $this->session->set_flashdata('comment_deleted','Comment has been deleted!');
        redirect('posts/viewdetails/'.$productId);
    }
}

?>