<?php
class posts_model extends CI_model{
    public $my_table;
    public $my_column_order = array();
    public $my_column_search = array();
    public $my_order = array();

    public function __construct(){
        $this->load->database();
        $this->user_type = $this->session->userdata('user_role'); 
    }

    //code to add product
    public function add_product($post_image =NULL){

        $data=array('productname'=>$this->input->post('productname'), 
                    'category'=>$this->input->post('category'),
                    'subcategory'=>$this->input->post('subcategory'),
                    'quantity'=>$this->input->post('quantity'),
                    'price'=>$this->input->post('price'),
                    'description'=>$this->input->post('description'),
                    'image'=> $post_image,
                    );
        return $this->db->insert('product',$data);
    }

    //code to get product
    public function get_product($id = NULL){
      
        if($id == NULL){  
            $query=$this->db->get_where('product',array('isdeleted' => 0));
            return $query->result_array();
        }
        $this->db->select('product.Id,productname,categories.categoryname,categories.id as cid,subcategory.id as sid,category ,subcategory ,subcategory.subcategoryname,quantity,price,image,description');
        $this->db->join('categories','product.category = categories.id');
        $this->db->join('subcategory','product.subcategory = subcategory.id');
        $this->db->order_by('product.createdat','asc');
        $this->db->where('product.Id',$id);
        $query = $this->db->get_where('product'); //array('Id'=>$id)
        return $query->row_array();


    }


    //code to get category  
    public function get_categories($id = NULL){
       
        if($id == NULL){
            $query=$this->db->get_where('categories',array('isdeleted'=>0));
            return $query->result_array();
        }
        $query = $this->db->get_where('categories',array('id'=>$id));
        return $query->row_array();
        
    }

    //code to get sub category
    public function get_subcategories($id = NULL){
    
        if($id == NULL){

            $query=$this->db->get_where('subcategory',array('isdeleted'=>0));
            return $query->result_array();
        }
        
        $this->db->select('subcategory.id,categories.categoryname,category_id   ,subcategoryname');
        $this->db->join('categories','subcategory.category_id = categories.id');
        $query =  $this->db->get_where('subcategory',array('subcategory.id'=> $id)); 
        return $query->row_array();
    }


    //code to add a category
    public function add_category(){
        $data=array('categoryname'=>$this->input->post('categoryname'),  );
        return $this->db->insert('categories',$data);
    }

    //code to add a subcategory
     public function add_subcategory(){
        $data=array('category_id' => $this->input->post('category_id'),
            'subcategoryname'=>$this->input->post('subcategoryname') );
        return $this->db->insert('subcategory',$data);
    }


    //code to delete product
    public function delete_product($id){
        $this->db->where('Id',$id);
        $this->db->update('product',array('isdeleted' => 1));
        return true;
    }

    //code to delete a category
    public function delete_category($id){
        $this->db->where('id',$id);
        $this->db->update('categories',array('isdeleted' => 1));
        return true;
    }

    //code to delete a sub category
    public function delete_subcategory($id){
        $this->db->where('id',$id);
        $this->db->update('subcategory', array('isdeleted' => 1));
        return true;
    }

     //code to update product
     public function update_product($post_image){
        $id=$this->input->post('Id');
        $data = array(
                      'productname' => $this->input->post('productname'),
                      'category'=>$this->input->post('category'),
                      'subcategory'=>$this->input->post('subcategory'),
                      'quantity'=>$this->input->post('quantity'),
                      'price'=>$this->input->post('price'),
                      'description'=>$this->input->post('description'),
                      'image'=>$post_image,
                    );
                    
        $this->db->where('product.Id',$id);
        return $this->db->update('product', $data);
    }

    //code to update category
    public function update_category(){
        
        $data = array('id' => $this->input->post('id'),
                    'categoryname' => $this->input->post('categoryname'));
        
        $this->db->where('id', $this->input->post('id'));

        return $this->db->update('categories', $data);
    }

    //code to update sub category
    public function update_sub_category(){

        $data = array(
                      'category_id' => $this->input->post('category_id'),
                      'subcategoryname' => $this->input->post('subcategoryname'));

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('subcategory', $data);
    }

    //code for category dropdown
    public function getCategory($id=NULL) { 
        $this->db-> select('id, categoryname');
        $this->db->where('isdeleted',0);
        $result = $this->db->get('categories')-> result_array(); 

        $query = $this->db->get_where('categories', array('id' => $id,'isdeleted' => 0));

        $category = array(); 
        foreach($result as $r) { 
            $category[$r['id']] = $r['categoryname']; 
        } 
    
        return $category; 
    } 

    //code for subcategory dropdown
    public function getsubCategory($categoryid=NULL) { 

        $this->db->select('id,category_id,subcategoryname');
        $this->db->where('isdeleted',0);
        $result = $this->db->get('subcategory') -> result_array(); 
        
        $query = $this->db->get_where('subcategory', array('category_id' => $categoryid,'isdeleted' => 0));
        
        return $query;

        $subcategory = array(); 
        foreach($result as $r) { 
            $subcategory[$r['id']] = $r['subcategoryname']; 
        } 
    
        return $subcategory; 


    } 


    //check category exists
    public function check_category_exists($category){
		$query = $this->db->get_where('categories', array('categoryname' => $category));
		if(empty($query->row_array())){
			return true;
		} else {
			return false;
		}
	}

    //check sub category exists
    public function check_subcategory_exists($subcategory){
		$query = $this->db->get_where('subcategory', array('subcategoryname' => $subcategory));
		if(empty($query->row_array())){
			return true;
		} else {
			return false;
		}
	}


    //datatables for product display
    public function get_datatables_query()
    {
        
        //assign queries to variables
        $this->my_table = 'product';
        $this->my_column_order = array('product.Id', 'productname', 'categories.categoryname', 'subcategory.subcategoryname', 'price', 'quantity', 'description');
        $this->my_column_search = array('productname', 'categories.categoryname', 'subcategory.subcategoryname', 'price', 'quantity', 'description');
        $this->my_order = array('createdat' => 'asc');

        //query
        $this->db->select($this->my_column_order);
        $this->db->from($this->my_table);
        $this->db->join('categories', 'product.category = categories.id');
        $this->db->join('subcategory', 'product.subcategory = subcategory.id');
        $this->db->where('product.isdeleted',0);

        $i = 0;

        foreach ($this->my_column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->my_column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->my_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->my_order)) {
            $order = $this->my_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function product_result_builder()
    {
        $this->get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function product_count_filtered()
    {
        $this->get_datatables_query();
    
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function product_count()
    {
         
        $this->db->from($this->my_table);
        $this->db->join('categories', 'product.category = categories.id');
        $this->db->join('subcategory', 'product.subcategory = subcategory.id');
        return $this->db->count_all_results();
    }

    public function product_json_builder($data)
    {
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product_count(),
            "recordsFiltered" => $this->product_count_filtered(),
            "data" => $data,
        );

        return json_encode($output);
    }

    //function to load product data on server side
    public function product_data()
    {
        $data = array();
        $product = $this->product_result_builder();
        foreach ($product as $row) {
            $subdata = array();
            $subdata[] = $row->Id;
            $subdata[] = $row->productname;
            $subdata[] = $row->categoryname;
            $subdata[] = $row->subcategoryname;
            $subdata[] = $row->quantity;
            $subdata[] = $row->price;
            $subdata[] = word_limiter($row->description, 15);
            $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="editproduct/' . $row->Id . ' "class="btn btn-warning"> EDIT </a>' : NULL;
            $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="deleteproduct/' . $row->Id . ' "class="btn btn-danger" onclick="return deletefn()"> DELETE </a>' : NULL;
            $subdata[] = '<a href="viewdetails/' . $row->Id . ' "class="btn btn-success"> VIEW DETAILS </a>';
            $data[] = $subdata;
        }
        return $this->product_json_builder($data);
    }



    //datable for sub-category display
    public function get_subcat_query()
    {
        //assign queries to the variables
        $this->my_table= 'subcategory';
        $this->my_column_search = array('categories.categoryname', 'subcategory.subcategoryname');
        $this->my_column_order =array('subcategory.id','categories.categoryname', 'subcategory.subcategoryname');
        $this->my_order = array('subcategory.id'=> 'asc');

        $this->db->select($this->my_column_order);
        $this->db->join('categories', 'categories.id = subcategory.category_id');
        $this->db->from($this->my_table);
        $this->db->where('subcategory.isdeleted',0);
        
        $i = 0;
       
        foreach ($this->my_column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->my_column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->my_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->my_order)) {
            $order = $this->my_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function subcategory_result_builder()
    {
        $this->get_subcat_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function subcategory_count_filtered()
    {
        $this->get_subcat_query();
    
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function subcategory_count()
    {
        $this->db->select('subcategory.id','categories.categoryname','subcategoryname');
        $this->db->join('categories', 'categories.id = subcategory.category_id');
        $this->db->from($this->my_table);
        $this->db->where('subcategory.isdeleted',0);
         
        return $this->db->count_all_results();
    }

    public function subcategory_json_builder($data)
    {
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subcategory_count(),
            "recordsFiltered" => $this->subcategory_count_filtered(),
            "data" => $data,
        );

        return json_encode($output);
    }

    //code to load category data on server side
    public function subcategory_data()
    {
        $data = array();
        $subcategory = $this->subcategory_result_builder();
        foreach ($subcategory as $row) {
            $subdata = array();
            $subdata[] = $row->categoryname;
            $subdata[] = $row->subcategoryname;
            $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="edit_subcategory/' . $row->id . ' "class="btn btn-warning"> EDIT </a>' : NULL;
            $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="delete_subcategory/' . $row->id . ' "class="btn btn-danger" onclick="return deletefn()"> DELETE </a>' : NULL;
            $data[] = $subdata;
        }
        return $this->subcategory_json_builder($data);
    }


   //datable for category display
   public function get_category_query()
   {
       //assign queries to the variables
       $this->my_table= 'categories';
       $this->my_column_search = array('categoryname');
       $this->my_column_order =array('id','categoryname');
       $this->my_order = array('id'=> 'asc');

       $this->db->select($this->my_column_order);
       $this->db->from($this->my_table);
       $this->db->where('isdeleted',0);
       
       $i = 0;
      
       foreach ($this->my_column_search as $item) {
           if ($_POST['search']['value']) {

               if ($i === 0) {
                   $this->db->group_start();
                   $this->db->like($item, $_POST['search']['value']);
               } else {
                   $this->db->or_like($item, $_POST['search']['value']);
               }

               if (count($this->my_column_search) - 1 == $i)
                   $this->db->group_end();
           }
           $i++;
       }

       if (isset($_POST['order'])) {
           $this->db->order_by($this->my_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       } else if (isset($this->my_order)) {
           $order = $this->my_order;
           $this->db->order_by(key($order), $order[key($order)]);
       }
   }

   public function category_result_builder()
   {
       $this->get_category_query();
       if ($_POST['length'] != -1)
           $this->db->limit($_POST['length'], $_POST['start']);
       $query = $this->db->get();
       return $query->result();
   }

   public function category_count_filtered()
   {
       $this->get_category_query();
   
       $query = $this->db->get();
       return $query->num_rows();
   }

   public function category_count()
   {
       $this->db->select('id','categoryname');
       $this->db->from($this->my_table);
       $this->db->where('isdeleted',0);
        
       return $this->db->count_all_results();
   }

   public function category_json_builder($data)
   {
       $output = array(
           "draw" => $_POST['draw'],
           "recordsTotal" => $this->category_count(),
           "recordsFiltered" => $this->category_count_filtered(),
           "data" => $data,
       );

       return json_encode($output);
   }

   //code to load sub category data on server side
   public function category_data()
   {
       $data = array();
       $subcategory = $this->category_result_builder();
       foreach ($subcategory as $row) {
           $subdata = array();
           $subdata[] = $row->categoryname;
           $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="editcategory/' . $row->id . ' "class="btn btn-warning"> EDIT </a>' : NULL;
           $subdata[] = ($this->user_type == 1 || $this->user_type == 2) ? '<a href="deletecategory/' . $row->id . ' "class="btn btn-danger" onclick="return deletefn()"> DELETE </a>' : NULL;
           $data[] = $subdata;
       }
       return $this->category_json_builder($data);
   }
}