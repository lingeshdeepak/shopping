<?php
class posts extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        $user_id = $this->session->userdata('id');
        if(!$user_id) {
            redirect('user/login');
        }
    }

    //Add Product
    public function addproduct(){
        if($this->session->userdata('user_role') == 1)
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $data['categories'] = $this->posts_model-> getCategory(); 
            $data['subcategory'] = $this->posts_model-> getsubCategory();

            $this->form_validation->set_rules('productname', 'ProductName', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('subcategory', 'SubCategory', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
        
            $this->form_validation->set_rules('description', 'Description', 'required');

            $this->form_validation->set_error_delimiters('<div id="error">', '</div>');

            if ($this->form_validation->run() == FALSE){
                $this->load->view('templates/header');
                $this->load->view('posts/addproduct',$data);
                $this->load->view('templates/footer');
            }
            else{         
                //upload image
                $config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
    
                $this->load->library('upload', $config);
                $query = $this->upload->do_upload('image');
                
                if ($query)
                {
                    $data = array('upload_data' => $this->upload->data());
                
                    $post_image = $_FILES['image']['name'];
                }
                else 
                {
                    $error = array('error' => $this->upload->display_errors());
        
                    // $post_image = 'image1.jpg';
                }
                $this->posts_model->add_product($post_image);
    
                $this->session->set_flashdata('Product_Updated', 'product updated');
                redirect('posts/product');
            }        
        }
    }


    //view product 
    public function product($offset =0){

        $data['posts']= $this->posts_model->get_product(FALSE,$offset);

        $data['categories'] = $this->posts_model-> getCategory(); 
        // $data['subcategory'] = $this->posts_model-> get_subCategories();
        $data['subcategory'] = $this->posts_model-> getsubCategory();

            $this->load->view('templates/header');
            $this->load->view('posts/product',$data);
            $this->load->view('templates/footer');
    }

    //Display category present in database
    public function categories(){
       
        $data['title']="Categories";

        // $data['posts']= $this->posts_model->get_categories();
        $data['posts']= $this->posts_model->getCategory();
			$this->load->view('templates/header');
			$this->load->view('posts/categories',$data);
            $this->load->view('templates/footer');
    }

    //Display Sub_category present in database
    public function subcategories(){


        $data['title']="Sub-Categories";
        
        $data['categories'] = $this->posts_model-> getCategory();

        $data['posts']= $this->posts_model->get_subcategories();
       
			$this->load->view('templates/header');
			$this->load->view('posts/subcategories',$data);
			$this->load->view('templates/footer');
    }


     //Add Category
    public function addcategory(){
        if($this->session->userdata('user_role') == 1)
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
    
            $data['title']="Add Category";  
    
            $this->form_validation->set_rules('categoryname', 'CategoryName', 'required|callback_check_category_exists');
            $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
    
            if ($this->form_validation->run() == FALSE){
                    $this->load->view('templates/header');
                    $this->load->view('posts/addcategory',$data);
                    $this->load->view('templates/footer');
            }
            else{            
            
                $this->posts_model->add_category();
                $this->session->set_flashdata('category_added', 'Category Added');
                redirect('posts/categories');
                }        
        }
    }

     //Add Sub-Category
    public function addsubcategory(){
        if($this->session->userdata('user_role') == 1)
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $data['categories'] = $this->posts_model-> getCategory();
            $this->form_validation->set_rules('category_id','Category_ID','required');
            $this->form_validation->set_rules('subcategoryname', 'SubCategoryName', 'required|callback_check_subcategory_exists');
            $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
    
            if ($this->form_validation->run() == FALSE){
                    $this->load->view('templates/header');
                    $this->load->view('posts/addsubcategory',$data);
                    $this->load->view('templates/footer');
            }
            else{
                $this->posts_model->add_subcategory();
                redirect('posts/subcategories'); 
                }        
        }
    }

    //delete product
    public function deleteproduct($id){
 
        $this->posts_model->delete_product($id);
        redirect('posts/product');
    }

    //delete category
    public function deletecategory($id){
       
        $this->posts_model->delete_category($id);
        redirect('posts/categories');
    }

    //delete Sub Category
    public function delete_subcategory($id){
     
        $this->posts_model->delete_subcategory($id);
        redirect('posts/subcategories');
    }


    //edit product
    public function editproduct($id){
     
        $data['post'] = $this->posts_model->get_product($id);

        $data['client'] = $this->posts_model->get_product();

        $this->load->view('templates/header');
        $this->load->view('posts/editproduct', $data);
        $this->load->view('templates/footer');


    }

    //update product
    public function updateproduct(){
        
        $config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $query = $this->upload->do_upload('image');
  
        if($_POST['checkBox'] == 1){
            if ($query)
            {
                $data = array('upload_data' => $this->upload->data());
          
                $post_image = $_FILES['image']['name'];
    
            }
            else 
            {
                $error = array('error' => $this->upload->display_errors());
            }
        }
        else{
            $post_image =$_POST['image12'];
        }
       

        $this->posts_model->update_product($post_image);

        redirect('posts/product');
    }

    //edit category
    public function editcategory($id){
    
        $data['post'] = $this->posts_model->get_categories($id);

        $data['categories'] = $this->posts_model->getCategory();

        $this->load->view('templates/header');
        $this->load->view('posts/editcategory', $data);
        $this->load->view('templates/footer');
    }

    //update category
    public function updatecategory(){
     
        $this->form_validation->set_rules('categoryname', 'CategoryName', 'required|callback_check_category_exists');
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');

       
            $this->posts_model->update_category();
            $this->session->set_flashdata('category_Updated', 'Category updated');
            redirect('posts/categories');

      
    }

    //edit sub category
    public function edit_subcategory($id){
  
        $data['post'] = $this->posts_model->get_subcategories($id);
        
        $data['subcategory'] = $this->posts_model->get_subcategories();

        $data['categories'] = $this->posts_model-> getCategory();
        
        $this->load->view('templates/header');
        $this->load->view('posts/edit_subcategory', $data);
        $this->load->view('templates/footer');
    }

    //update sub category
    public function update_subcategory(){
        $this->form_validation->set_rules('subcategoryname', 'SubCategoryName', 'required|callback_check_subcategory_exists');
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->posts_model->update_sub_category();

        redirect('posts/subcategories');
    }

    //view product details
    public function viewdetails($id = NULL) {
        if($id <> NULL) {
            $data['post'] = $this->posts_model->get_product($id);
            $data['comments'] = $this->comment_model->getCommentDetails($id);

            $this->load->view('templates/header');
            $this->load->view('posts/viewdetails',$data);
            $this->load->view('templates/footer');
        }
    }

    //get subcategory for dropdown
    public function get_subcategory(){
       
        if(isset($_POST['id'])) { 
            $categoryid = $this->input->post('id',TRUE);
            $data = $this->posts_model->getsubCategory($categoryid)->result();
            echo json_encode($data);
        }
    }
 

    //check if category name exists
    public function check_category_exists($category = NULL){
        if ($category == NULL) {
            echo $this->posts_model->check_username_exists($_POST['category']);
        }
        else {
            $this->form_validation->set_message('check_category_exists', 'That category is taken. Please choose a different one');
            if($this->posts_model->check_category_exists($category)){
                return true;
            } else {
                return false;
            }
        }
    }


    //CHECK IF SUB CATEGORY NAME EXISTS 
    public function check_subcategory_exists($subcategory = NULL){
        if ($subcategory == NULL) {
            echo $this->posts_model->check_subusername_exists($_POST['subcategory']);
        }
        else {
            $this->form_validation->set_message('check_subcategory_exists', 'That category is taken. Please choose a different one');
            if($this->posts_model->check_subcategory_exists($subcategory)){
                return true;
            } else {
                return false;
            }
        }
    }

    //server side loading product data
    public function get_allproduct()
    {
       echo $this->posts_model->product_data();
   
    }

    //server side loading category data
    public function get_allsubcategory()
    {
        echo $this->posts_model->subcategory_data();
    }

    //server side loading sub-category data
    public function get_allcategory()
    {
        echo $this->posts_model->category_data();
    }
}