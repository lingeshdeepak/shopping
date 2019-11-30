<h2>ADD CATEGORY</h2>

<?php 
$attributes=array(
  'id'=>"addCategory",
);
echo form_open('posts/addcategory',$attributes); ?> 
<div class="form">
    <div class=" col-md-4 col-md-offset-4 ">  
      <div class="form-group">
        <label>CategoryName *</label>
        <input type="text" class="form-control" id="category" name="categoryname" placeholder="CategoryName">
        <?php echo form_error('categoryname', '<div id="error">', '</div>'); ?>
        <div class="errcategory1" style="display:none;color:red">CategoryName is reqiured</div>
      </div>
      <button type="submit" class="btn btn-success" id="submit" name="submit">ADD CATEGORY</button>
      <a href="<?php echo base_url()?>posts/categories" class="btn btn-info" >BACK</a>
    </div>
</div>

<?php echo form_close(); ?>




