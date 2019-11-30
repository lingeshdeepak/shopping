

<div class="register">
<?php
$attributes=array(
	'id'=>"register"
);
 echo form_open('user/register',$attributes); ?>

		<h1 class="text-center"><?= $title; ?></h1>
		<div class="form-group">
			<label>Name *</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name">
			<?php echo form_error('name', '<div id="error">', '</div>'); ?>
			<div class="errname" style="display:none;color:red">Name is reqiured</div>
		</div>
		<div class="form-group">
			<label>Email *</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email">
			<?php echo form_error('email', '<div id="error">', '</div>'); ?>
			<div class="erremail" style="display:none;color:red">Email is reqiured</div>
			<div class="erremail1" style="display:none;color:red">Email already exists</div>
		</div>
		<div class="form-group">
			<label>Username *</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
			<?php echo form_error('username', '<div id="error">', '</div>'); ?>
			<div class="errusername" style="display:none;color:red">UserName is reqiured</div>
			<div class="errusername1" style="display:none;color:red">UserName already taken</div>
		</div>
		<div class="form-group">
			<label>Password *</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			<?php echo form_error('password', '<div id="error">', '</div>'); ?>
			<div class="errpassword" style="display:none;color:red">Password is reqiured</div>
		</div>
		<div class="form-group">
			<label>Confirm Password *</label>
			<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
			<?php echo form_error('confirmpassword', '<div id="error">', '</div>'); ?>
			<div class="errconfirmpassword" style="display:none;color:red">Confirm Password is reqiured</div>
			<div class="errconfirmpassword1" style="display:none;color:red">Password does not match</div>
		</div>
		<button type="submit" class="btn btn-primary btn-block" >Register</button>
		<a href="<?php echo base_url()?>user/login" class="btn btn-warning btn-block">Back</a>
	<?php echo form_close(); ?>
</div>


