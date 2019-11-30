<h2>Product</h2>

<div id="product_table">
  <table class=" table-hover table-striped" id="product">
    <thead> 
      <th>ID</th>
      <th>ProductName</th>
      <th>Category</th>
      <th>Sub_Category</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Description</th>
      <?php if( $this->session->userdata('user_role') == 1):?>
      <th>Edit</th>
      <th>Delete</th>
      <?php endif;?>
      <th>View</th>
    </thead>
    <tbody>
    </tbody>
  </table>

</div>






<!-- tbody -->





