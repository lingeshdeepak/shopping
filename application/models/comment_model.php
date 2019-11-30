<?php
class Comment_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

     public function createComment($user_id)
    {
        
        $data = array (
            'productId' => $this->input->post('productId'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body'),
            'user_id'=> $user_id
        );


       $query = $this->db->insert('comments',$data);
       return $query;
    }

    public function getCommentDetails($prod_id)
    {
        $query = $this->db->get_where('comments',array('productId' => $prod_id,'isdeleted' => 0));
        return $query->result_array();
    }

    public function getComment($id)
    {
        $query = $this->db->get_where('comments',array('commentid' => $id,'isdeleted' => 0));
        return $query->row_array();
    }

    public function updateComment() 
    {
        $id=$this->input->post('commentId');
 

        $data = array (
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body')
        );
      
         $this->db->where('commentid',$id);
       return $this->db->update('comments',$data);
    }

    public function deleteComment($id) {
        $this->db->where('commentid', $id);
        $this->db->update('comments',array('isdeleted' => 1));
    }
}

?>