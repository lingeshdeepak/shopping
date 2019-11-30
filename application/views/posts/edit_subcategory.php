<h2>UPDATE SUB-CATEGORY</h2>

<?php echo validation_errors(); ?>
 
<?php 
$attributes=array(
  'method'=>"POST",
  'id'=>"editSubCategory"
);
echo form_open('posts/update_subcategory',$attributes) ?>
  <div id="subform">
    <div class=" col-md-4  ">
      <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $post['id']; ?>">

        <select name="category_id" id="category">
            <?php foreach( $categories as $result=>$category): ?>
          <option value="<?php echo $result?>" <?php if( $result == $post['category_id'] ): ?> selected="selected"<?php endif; ?> ><?php echo $category?></option> 
          <?php endforeach; ?> 
       </select>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="subcategoryname" id="subcategory" placeholder="SubCategoryName" value="<?php echo $post['subcategoryname']; ?>">
        <div class="errsubcategory" style="display:none;color:red">subcategory is required</div>
      </div>
      <button type="submit" class="btn btn-success">UPDATE</button>
      <a href="<?php echo base_url()?>posts/subcategories" class="btn btn-info" >BACK</a>
    </div>
  </div>










<!-- 
    <?php echo validation_errors(); ?>
    <?php
    echo form_open('posts/update_subcategory'); 
      $opendiv='<div   class="col-md-4 col-md-offset-4" id="subform">';
      $closediv='</div>';
      
      
      echo form_fieldset($opendiv);
  
        echo form_label('Category'); 

        echo form_dropdown('category',);
         foreach( $categories as $result=>$category){
            echo ('<option value="<?php echo $result?>" <?php if( $result == $post["category_id"] ): ?> selected="selected"<?php endif; ?> ><?php echo $category;?></option>' );
          }   
      echo  '<br>';
     
          echo form_label('Sub-Category Name');
        
          $hidden= array(
            'id' => 'id',
            'name' => 'id',
            'value' => $post['id']
          ); 
          echo form_hidden($hidden);
              
          $subcategory= array(
            'id' => 'subcategory',
            'name' => 'subcategory',
            'value' => $post['subcategoryname']
          ); 
          
          echo form_input($subcategory);       
        echo  '<br>';
          
        $submit= array(
          'name'=>'update',
          'class'=>'btn btn-success'
        ); 
  echo  '<br>';
      echo form_submit($submit,'UPDATE') ;

  echo form_fieldset($closediv);

  echo form_close(); 
?>  -->