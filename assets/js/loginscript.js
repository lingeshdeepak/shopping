$(document).ready(function(){

  //login javascript
  $("#login").submit(function(){
    if($("#username").val()<1){
      $(".errusername").css("display", "inline");
 
    }
    else{
      $(".errusername").css("display", "none");
    }
    if($("#password").val()<1){
      $(".errpassword").css("display", "inline");
      
    }
    else{
      $(".errpassword").css("display", "none");
    }

    if($("#username").val() =="" || $("#password").val() == "") 
    {
    
    return false;
  }
  else {
    return true;
  }
  });
  
  //register javascript

  var CheckUser;
  var CheckEmail;
  $('#username').blur(function() {
      var username = $('#username').val();
      if (username != '') {
          $.ajax({
              url: "<?php echo base_url('user/check_username_exists'); ?>",
              type: "POST",
              data: {
                  username: username
              },
              success: function(response) {
                  if (response == false) {
                      CheckUser = false;
                      $(".errusername1").css("display", "inline");
                  } else if (response == true) {
                      CheckUser = true;
                      $(".errusername1").css("display", "none");
                  }
              }
          });
      }
  });
  $('#email').blur(function() {
      var email = $('#email').val();
      if (email != '') {
          $.ajax({
              url: "<?php echo base_url('user/check_email_exists'); ?>",
              type: "POST",
              data: {
                  email: email
              },
              success: function(response) {
                  if (response == false) {
                      CheckEmail = false;
                      $(".erremail1").css("display", "inline");
                  } else if (response == true) {
                      CheckEmail = true;
                      $(".erremail1").css("display", "none");
                  }
              }
          });
      }
  });
  $("#register").submit(function(){

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

      if ($("#username").val() < 1) {
          $(".errusername").css("display", "inline");
      }
      else {
          $(".errusername").css("display", "none");
          submit = 1;
      }

      if ($("#password").val() < 1) {
          $(".errpassword").css("display", "inline");
      }
      else {
          $(".errpassword").css("display", "none");
      }

      if ($("#confirmpassword").val() < 1) {
          $(".errconfirmpassword").css("display", "inline");
      }
      else {
      $(".errconfirmpassword").css("display", "none");
      }
      if ($("#password").val() != $("#confirmpassword").val()) {
      $(".errconfirmpassword1").css("display", "inline");
  } else {
      $(".errconfirmpassword1").css("display", "none");
  }

      if (CheckUser == false || CheckEmail == false ||$("#name").val() < 1 || $("#email").val() < 1 || !$("#email").val().match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)
      || $("#username").val() < 1 || $("#password").val() < 1 || $("#confirmpassword").val() < 1 || $("#password").val() != $("#confirmpassword").val()){
      return false;
      }
      else {
      return true;
      }
  });
   });