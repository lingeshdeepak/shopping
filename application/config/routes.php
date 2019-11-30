<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['comments/editComment']='comments/editComment';
$route['comments/createComment']='comments/createComment';



$route['posts/viewdetails']='posts/viewdetails';
$route['posts/editproduct']='posts/editproduct';
$route['posts/edit_subcategory']='posts/edit_subcategory';
$route['posts/editcategory']='posts/editcategory';
$route['posts/addsubcategory']='posts/addsubcategory';
$route['posts/addcategory']='posts/addcategory';
$route['posts/subcategories']='posts/subcategories';
$route['posts/categories']='posts/categories';
$route['posts/addproduct']='posts/addproduct';
$route['posts/product']='posts/product';


$route['default_controller'] = 'user/login';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

