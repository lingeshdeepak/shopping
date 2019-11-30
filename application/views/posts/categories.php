<h2><?=$title?></h2>



<div id="category_table">
  <?php if( $this->session->userdata('user_role') == 1):?>
    <button onclick="location.href='<?php echo base_url();?>posts/addcategory'" class="btn btn-success" id="cataddbtn">ADD CATEGORY</button>
  <?php endif;?>
  <table class="categorytable table-hover table-bordered" id="categorytable">
    <thead>
      <th>Category</th>
      <?php if( $this->session->userdata('user_role') == 1):?>
      <th>Edit</th>
      <th>Delete</th>
      <?php endif;?>      
    </thead>

  </table>
 
</div>



  

 