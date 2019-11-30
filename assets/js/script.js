function deletefn(){
  if(confirm("Are you sure!Do you want to delete the selected item")){
    alert("selected item  is deleted");
    return true;
  }
  else{ 
    return false;
  }
}

function selectimage() {
  if ($('.selectimage').is(":checked"))
    $("#check").css("visibility", "visible");
  else
    $("#check").css("visibility", "hidden");
}

function imgView(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
      reader.onload = function (e) {
      $('#image1')
      .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

var product;
var subcategory;
var category;
$(document).ready(function(){

  product=$('#product').DataTable({
    processing: true,
    serverSide: true,
    order:[], 
    lengthMenu: [[5, 10, 25,100, -1], [5, 10, 25,100, "All"]],
    ajax: {
      url: "get_allproduct",
      type: 'POST'
    },
    columnDefs: [
    {
      targets: [7, 8, 9],
      orderable: false,
      searchable: false
    },
    ],
  });

  subcategory=$('#subcategorytable').DataTable({
    processing: true,
    serverSide: true,
    order:[], 
    lengthMenu: [[5, 10, 25,100, -1], [5, 10, 25,100, "All"]],
    ajax: {
      url: "get_allsubcategory",
      type: 'POST'
    },
    columnDefs: [
    {
      targets: [2,3],
      orderable: false,
      searchable: false
    },
    ],
  });

  category=$('#categorytable').DataTable({
    processing: true,
    serverSide: true,
    order:[], 
    lengthMenu: [[5, 10, 25,100, -1], [5, 10, 25,100, "All"]],
    ajax: {
      url: "get_allcategory",
      type: 'POST'
    },
    columnDefs: [
    {
      targets: [1,2],
      orderable: false,
      searchable: false
    },
    ],
  });

  //addproduct and EditProduct javascript
  //image
  $("#image").blur(function(){
    var image = $('#image').val().split('.').pop().toLowerCase();
    var format=[];
    format.push('gif', 'jpg', 'png', 'jpeg');
    if(image){
      if ($.inArray(image,format) == -1){ 
        $(".errimage1").css("display", "inline");
      }
      else {
        $(".errimage1").css("display", "none");
      }
    }
});

  $("#addproduct").submit(function(){
   
    var image = $('#image').val().split('.').pop().toLowerCase();
      if ($("#productname").val() < 1) {
         $(".productname").css("display", "inline");
      } 
      else {
        $(".productname").css("display", "none");
      
      }
  
    if ($("#category").val() < 1) {
          $(".errcategory").css("display", "inline");
    }
    else {
          $(".errcategory").css("display", "none");
    }

    if ($("#subcategory").val() < 1) {
        $(".errsubcategory").css("display", "inline");
    }
    else {
        $(".errsubcategory").css("display", "none");
        submit = 1;
      }

    if ($("#price").val() < 1) {
          $(".errprice").css("display", "inline");
    }
    else {
        $(".errprice").css("display", "none");
    }

     if ($("#quantity").val() < 1) {
        $(".errquantity").css("display", "inline");
    }
    else {
      $(".errquantity").css("display", "none");
    }

    if ($("#description").val() < 1) {
      $(".errdescription").css("display", "inline");
    }
    else {
      $(".errdescription").css("display", "none");
    }
    //image
    if (image == '') {
      $(".errimage2").css("display", "inline");
      return false;
    }
    else if ($('.errimage1').css('display') =='inline' || $('.errimage2').css('display')== 'inline' || $("#productname").val() < 1 || $("#category").val() ==" " 
    || $("#subcategory").val() ==" "   || $("#quantity").val() ==" " || $("#price").val() ==" "|| $("#description").val() == "") {
      
      $(".errimage2").css("display", "none");
      return false;
    }
    else {
      $(".errimage2").css("display", "none");

      return true;
    }
  });

  $("#editproduct").submit(function(){
    var checked;
    if ($("input[type=checkbox]").is(":checked")) {
          checked = 1;
    }
    else {
          checked = 0;
    }
    var image = $('#image').val().split('.').pop().toLowerCase();
      if ($("#productname").val() < 1) {
         $(".productname").css("display", "inline");
      } 
      else {
        $(".productname").css("display", "none");
      
      }
  
    if ($("#category").val() < 1) {
          $(".errcategory").css("display", "inline");
    }
    else {
          $(".errcategory").css("display", "none");
    }

    if ($("#subcategory").val() < 1) {
        $(".errsubcategory").css("display", "inline");
    }
    else {
        $(".errsubcategory").css("display", "none");
        submit = 1;
      }

    if ($("#price").val() < 1) {
          $(".errprice").css("display", "inline");
    }
    else {
        $(".errprice").css("display", "none");
    }

     if ($("#quantity").val() < 1) {
        $(".errquantity").css("display", "inline");
    }
    else {
      $(".errquantity").css("display", "none");
    }

    if ($("#description").val() < 1) {
      $(".errdescription").css("display", "inline");
    }
    else {
      $(".errdescription").css("display", "none");
    }
    //image
    if (checked==1 && image == '') {
      $(".errimage2").focusout().css("display", "inline");
      return false;
    }
    else if ($('.errimage1').css('display') =='inline' || checked==1 && image == '' || $("#productname").val() < 1 || $("#category").val() ==" " 
    || $("#subcategory").val() ==" "   || $("#quantity").val() ==" " || $("#price").val() ==" "|| $("#description").val() == "") {
    
      return false;
    }
    else {
      return true;
    }
  });

  $("#addCategory,#editCategory").submit(function(){
    if ($("#category").val()<1) {
      $(".errcategory1").css("display", "inline");
 
      return false;
    } 
    else {
      $(".errcategory1").css("display", "none");
      return true;
    }
  });

  // javascript for addsubcategory and editsubcategory
  $("#addSubCategory, #editSubCategory").submit(function () {
    if ($("#category").val() < 1) {
          $(".errcategory").css("display", "inline");
    }
    else {
          $(".errcategory").css("display", "none");
    }
    if ($("#subcategory").val() < 1) {
          $(".errsubcategory").css("display", "inline");
    }
    else {
          $(".errsubcategory").css("display", "none");
    }
    if ($("#category").val() < 1 || $("#subcategory").val() < 1) {
        
          return false;
    }
    else {
          return true;
    }
});

  //javascript for addcomment and editcomment
$("#addComment, #editComment").submit(function () {
  if ($("#name").val() < 1) {
    $(".errname").css("display", "inline");
  }
  else {
    $(".errname").css("display", "none");
  }

  if ($("#email").val() < 1) {
    $(".erremail").css("display", "inline");
  }
  else if (!$("#email").val().match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)) {
    $(".erremail").css("display", "inline");
    $(".erremail").css("value", "");
    $(".erremail").html("Enter a valid Email Address!");
  }
  else {
    $(".erremail").css("display", "none");
  }

  if ($("#comment").val() < 1) {
    $(".errbody").css("display", "inline");
  }
  else {
    $(".errbody").css("display", "none");
  }
  if ($("#name").val() =="" || $("#email").val() =="" || !$("#email").val().match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)|| $("#comment").val()=="") {

    return false;
  }
  else {
    return true;
  }
});


});



