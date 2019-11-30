<h2>EDIT CATEGORY</h2>

<?php echo validation_errors(); ?>

<?php 
$attributes=array(
  'id'=>"editCategory",
 
);
echo form_open('posts/updatecategory',$attributes)?>

<div class="categoryform">
    <div class=" col-md-4">
      <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label>CategoryName</label>
        <input type="text" class="form-control" id="category" name="categoryname" placeholder="CategoryName" value="<?php echo $post['categoryname']; ?>">
        <?php echo form_error('categoryname', '<div id="error">', '</div>'); ?>
        <div class="errcategory1" style="display:none;color:red">CategoryName is reqiured</div>
      </div>
  
      <button type="submit" class="btn btn-success" id="submit">UPDATE CATEGORY</button>
      <a href="<?php echo base_url()?>posts/categories" class="btn btn-info" >BACK</a>
    </div>
</div>

<?php echo form_close(); ?>