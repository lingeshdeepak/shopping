<h2>ADD SUB-CATEGORY</h2>

<form method="post" id="addSubCategory">
  <div id="subform">
    <div class=" col-md-4 ">
      <div class="form-group">
        <label>Category *</label><br>
       <select name="category_id" id="category">

       <option disabled selected>--Select Category--</option>
          <?php foreach( $categories as $result=>$category): ?>
           <option value="<?php echo $result?>"><?php echo $category?></option>
          <?php endforeach; ?> 
       </select>
       <?php echo form_error('category_id', '<div id="error">', '</div>'); ?>
       <div class="errcategory" style="display:none;color:red">category is required</div>
      </div>
      <div class="form-group">
        <label>Sub-CategoryName *</label>
        <input type="text" class="form-control" name="subcategoryname" placeholder="SubCategoryName" id="subcategory">
        <?php echo form_error('subcategoryname', '<div id="error">', '</div>'); ?>
        <div class="errsubcategory" style="display:none;color:red">subcategory is required</div>
      </div>
      <button type="submit" class="btn btn-success">SUBMIT</button>
      <a href="<?php echo base_url()?>posts/subcategories" class="btn btn-info" >BACK</a>
    </div>
  </div>

<?php echo form_close(); ?>