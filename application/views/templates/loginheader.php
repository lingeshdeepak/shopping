<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo site_url()."assets/css/bootstrap.min.css"?>"/>
<link href="<?php echo site_url()."assets/css/loginstyle.css"?>" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>

<div>


  <div class="container">
    <?php if($this->session->flashdata('user_registered')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('login_failed')): ?>
    <?php echo '<p class="alert alert-danger" style="text-align:center">'.$this->session->flashdata('login_failed').'</p>'; ?>
    <?php endif; ?>
  </div>
