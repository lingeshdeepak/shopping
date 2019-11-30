


<h2>ADD PRODUCT</h2>

<?php 
$attributes=array(
  'id'=>"addproduct"
);
echo form_open_multipart('posts/addproduct',$attributes); ?>
<div class="productform"> 

  <div class="form">
      <div class="row">
        <label>ProductName *</label>
        <input type="text"   name="productname" placeholder="ProductName" id="productname">
        <?php echo form_error('productname', '<div id="error">', '</div>'); ?>
        <div class="productname" style="display:none;color:red">ProductName is reqiured</div>
      </div>
      <div class="row">
        <label>Category *</label><br>
       <select name="category" id="category">
         <option disabled selected>--Select Category--</option>
          <?php foreach( $categories as $result=>$category): ?>
           <option value="<?php echo $result?>"><?php echo $category?></option>
          <?php endforeach; ?> 
       </select>
       <?php echo form_error('category', '<div id="error">', '</div>'); ?>
       <div class="errcategory" style="display:none;color:red">Category is reqiured</div>
      </div>
      <div class="row">
          <label>Sub-Category *</label><br>
          <select name="subcategory" id="subcategory">
            <option disabled selected>--Select SubCategory--</option>
        </select>
        <?php echo form_error('subcategory', '<div id="error">', '</div>'); ?>
        <div class="errsubcategory" style="display:none;color:red">SubCategory is reqiured</div>
      </div>
      <div class="row">
        <label>Quantity *</label>
        <input type="number"   name="quantity" placeholder="Quantity" id="quantity" min="0" max="10000">
        <?php echo form_error('quantity', '<div id="error">', '</div>'); ?>
        <div class="errquantity" style="display:none;color:red">Quantity is reqiured</div>
      </div>
      <div class="row">
        <label>Price *</label>
        <input type="number"   name="price" placeholder="Price" id="price"  min="0" max="1000000">
        <?php echo form_error('price', '<div id="error">', '</div>'); ?>
        <div class="errprice" style="display:none;color:red">Price is reqiured</div>
      </div>
      
      <div class="row">
        <label>Upload Image *</label>
        <input type="file" id="image" name="image" onchange="imgView(this)" >
        <div class="errimage1" style="display:none;color:red"> Image Format Should be JPG, JPEG, PNG or GIF. </div>
        <div class="errimage2" style="display:none;color:red"> No Image Selected.</div>
        </div>

        <div class="row">
        <label>Image Preview</label>
        <img src="<?php echo base_url()?>assets/images/no image.jpg" width="200px" height="200px" id="image1">
        </div>
     
      <div class="row">
        <label>Description *</label>
        <textarea name="description" placeholder="PRODUCT DESCRIPTION" cols="50" rows="5" id="description" maxlength="255"></textarea>
        <?php echo form_error('description', '<div id="error">', '</div>'); ?>
        <div class="errdescription" style="display:none;color:red">Description is reqiured</div>
      </div>
      <div class="row">
        <button type="submit" class="btn btn-success" id="submit">SUBMIT</button>
        <a href="<?php echo base_url()?>posts/product" class="btn btn-info" >BACK</a>
      </div>
     
  </div>
</div>
  

<?php echo form_close(); ?>