<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url()."assets/css/bootstrap.min.css"?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url()."assets/DataTables/css/jquery.dataTables.min.css"?>"/>
<title>SHOPPING</title>
    <!-- <script src="http://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> -->
    <link href="<?php echo site_url()."assets/css/style.css"?>" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
    

<nav class="navbar navbar-default " id="navigation">
    
    <ul class="navbar navbar-left" id="navleft">
        <li><a class="nav-link" href="<?php echo base_url()?>posts/product">Home <span class="sr-only"></span></a></li>
        <?php if( $this->session->userdata('user_role') == 1):?>
            <li><a class="nav-link" href="<?php echo base_url()?>posts/addproduct">Add Product</a></li>
        <?php endif;?>
            <li><a class="nav-link" href="<?php echo base_url()?>posts/categories">Categories</a></li>
            <li><a class="nav-link" href="<?php echo base_url()?>posts/subcategories">Sub Categories</a></li> 
        
    </ul>
    <ul style="float:right" id="navright">
        <li><a href="<?php echo base_url()?>posts/product"><?php echo  $this->session->userdata('username'); ?></a></li>
        <li><a class="nav-link" href="<?php echo base_url()?>user/logout/">Log Out</a></li>
    </ul>
</nav>


<div>


    <div class="container">

        <?php if($this->session->flashdata('category_added')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_added').'</p>'; ?>
        <?php endif; ?>

    <?php if($this->session->flashdata('category_Updated')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_Updated').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('Product_Updated')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('Product_Updated').'</p>'; ?>
    <?php endif; ?>

    <!-- login failed -->
    <?php if($this->session->flashdata('login_failed')): ?>
    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
    <?php endif; ?>

    <!-- login success -->
    <?php if($this->session->flashdata('user_loggedin')): ?>
    <?php echo '<p class="alert alert-success" style="text-align:center">WELCOME '.$this->session->userdata('username').'</p>'; ?>
    <?php endif; ?>
</div>
    
