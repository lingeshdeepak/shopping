
<h2>EDIT PRODUCT</h2>
<?php echo validation_errors(); ?>
<?php 
$attributes=array(
  'method'=>"POST",
  'id'=>"editproduct"
);
echo form_open_multipart('posts/updateproduct',$attributes) ?>
  <div class="productform">
      <div class="form-group">
      <input type="hidden" name="Id" value="<?php echo $post['Id']; ?>">
        <label>ProductName</label>
        <input type="text"    name="productname" id="productname" placeholder="ProductName" value="<?php echo $post['productname']; ?>">
        <div class="productname" style="display:none;color:red">ProductName is reqiured</div>
      </div>

      <div class="form-group">
        <label>Category</label><br>

       <select name="category"  id="category"> 
       <option disabled selected >--Select Category--</option>
      
          <?php foreach( $categories as $result=>$category): ?>
         
           <option value="<?php echo $result ?>" <?php if( $result == $post['cid'] ): ?>selected='selected'<?php endif; ?>> <?php echo $category; ?></option>
          <?php endforeach; ?> 
       </select>
       <div class="errcategory" style="display:none;color:red">Category is reqiured</div>
      </div>

      <div class="form-group">
        <label>Sub-Category</label><br>
        <!-- <?php echo form_dropdown('subCategory', $post['subcategoryname']);?> -->

        <select name="subcategory"  id="subcategory">
          <option disabled selected>--Select SubCategory--</option>
          <?php foreach( $subcategory as $subcategories): ?>
           <option value="<?php echo $subcategories['id']?>" <?php if($subcategories['id'] == $post['sid'] ): ?> selected="selected"<?php endif; ?>><?php echo $subcategories['subcategoryname']; ?></option>
          <?php endforeach; ?> 
       </select>
       <div class="errsubcategory" style="display:none;color:red">SubCategory is reqiured</div>
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input type="number"    id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $post['quantity']; ?>">
        <div class="errquantity" style="display:none;color:red">Quantity is reqiured</div>
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="number"    name="price" id="price" placeholder="Price" value="<?php echo $post['price']; ?>">
        <div class="errprice" style="display:none;color:red">Price is reqiured</div>
      </div>

      <div class="form-group">
      <label>Upload Image</label>
      <input class="selectimage" type="checkbox" id="checkBox" name="checkBox" value="1" onchange="selectimage()"> Change Image
      <div id="check" style="visibility:hidden">
            <input type="hidden" name="image12" value="<?php echo $post['image']; ?>"> 
        <input type="file" id="image" name="image"  onchange="imgView(this)">
        <div class="errimage1" style="display:none;color:red"> Image Format Should be JPG, JPEG, PNG or GIF. </div>
        <div class="errimage2" style="display:none;color:red"> No Image Selected. Select an image  </div>
      </div>
        <img src="<?php echo base_url()?>/assets/images/<?php echo $post['image']; ?>" alt="image" width="100px" height="100px" id="image1">
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" placeholder="PRODUCT DESCRIPTION" cols="73" rows="10"><?php echo $post['description']; ?></textarea>
        <div class="errdescription" style="display:none;color:red">Description is reqiured</div>
      </div>
      
      <button type="submit" class="btn btn-success">UPDATE</button>
      <a href="<?php echo base_url()?>posts/product" class="btn btn-info" >BACK</a>
    </div>

<?php echo form_close(); ?>
  

<html>
  <head>
    <link href="<?php echo site_url()."assets/css/style.css"?>" rel="stylesheet" type="text/css" media="all"/>
  </head>
 
</html>