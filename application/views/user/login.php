<div class="row">

<?php
	$attributes=array(
		'class'=>'testform',
		'method'=>'post',
		'id'=>"login");
	echo form_open('user/login',$attributes);
	$opendiv='<div  class="col-md-4 col-md-offset-4" id="login">';
	$closediv='</div>';
	$startDiv='<div class="form-group" >';
	$endDiv='</div>';
	$errdiv='<div class="errusername" style="dispaly:none;color:red">';
	$enderrdiv='</div>';
	echo ($opendiv);
	echo form_fieldset($startDiv);
	echo ("<h1><center>SIGN IN</center></h2>");
	echo '<br>';
	echo form_label('Name *');
	$text=array(
		'class'=>'testName form-control',
		'name'=>'username',
		'placeholder'=>'username',
		'id'=>'username');
	echo form_input($text);
	echo form_error('username', '<div id="error">', '</div>');
	echo "<div class='errusername' style='display:none;color:red;size:8px'>username is required</div>";
	

	echo form_label('Password *');
	$password=array(
		'name'=>'password',
		'class'=>'testPassword form-control',
		'placeholder'=>'password',
		'id'=>'password');
	echo form_password($password);
	echo form_error('password', '<div id="error">', '</div>');
	echo "<div class='errpassword' style='display:none;color:red;size:8px'>password is required</div>";
	
	
	echo '<br>';
	$submit=array(
		'value'=>'Submit',
		'class'=>'btn btn-success btn-block');
	echo form_submit($submit);

	echo form_fieldset_close($endDiv);
	echo ($closediv);

?>

</div>

<div class="row" id="signup">
	<p >NEW USER</p>
	<a href="<?php echo base_url()?>user/register">SIGN UP/REGISTER</a>
</div>