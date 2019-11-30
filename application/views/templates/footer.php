</div>
  <script src="<?php echo base_url()."assets/js/jquery.js"?>"></script>
  <script src="<?php echo base_url()."assets/js/script.js"?>"></script>
  <script src="<?php echo base_url()."assets/js/jquery.min.js"?>"></script>
  <!-- <script src="<?php echo base_url()."assets/js/bootstrap.min.js"?>"></script> -->

  <script type="text/javascript" src="<?php echo site_url()."assets/DataTables/js/jquery.dataTables.min.js"?>"></script>

  <!-- <script>CKEDITOR.replace( 'description' );</script>-->
      <script type="text/javascript"> 
    $(document).ready(function(){
      $('#category').change(function(){ 
        var id=$(this).val();
        $.ajax({
          url : "<?php echo site_url('posts/get_subcategory');?>",
          method : "POST",
          data : {id: id},
          async : true,
          success: function(data){
              subcategories = JSON.parse(data);
              $('#subcategory').empty();
              subcategories.forEach(function(subcategories){
         
                $('#subcategory').append('<option value='+subcategories.id+'>' + subcategories.subcategoryname+ '</option>');
              }); 
              $('#subcategory').append('<option disabled selected>' +'--Select Sub Category--'+ '</option>');
          }
        });
        return false;
      }); 
    });
    </script>
</body>
</html>