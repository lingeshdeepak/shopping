
<h2><?=$title?></h2>
<div id="subcategory_table">
   <table class="subtable table-hover" id="subcategorytable">
      <thead>
         <!-- <th>id</th> -->
         <th>Category</th>
         <th>SubCategory</th>
         <?php if( $this->session->userdata('user_role') == 1):?>
         <th>Edit</th>
         <th>Delete</th>
         <?php endif;?>
      </thead>
      
      
      <?php if( $this->session->userdata('user_role') == 1):?>
            <button onclick="location.href='<?php echo base_url();?>posts/addsubcategory'" class="btn btn-success" id="subaddbtn">ADD SUB-CATEGORY</button>
      <?php endif;?>
   </table>

  
</div>
