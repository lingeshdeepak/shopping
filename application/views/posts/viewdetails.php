<h2 style="text-align:center">Product Details</h2>

<a href="<?php echo base_url()?>posts/product" class="btn btn-info btn-lg movebtn" >BACK</a>


    <div class="card">
      <img src="<?php echo site_url(); ?>assets/images/<?php echo $post['image']; ?>" alt="<?php echo $post['productname']; ?>" style="width:50%">
        <h1><?php echo $post['productname']; ?></h1>
        <p><h4>Category:</h4> <span id="text"><?php echo $post['categoryname']; ?></span></p>
        <p><h4>Sub-Category:</h4> <span id="text"><?php echo $post['subcategoryname']; ?></span></p>
        <p><h4>Description:</h4> <span id="text"><?php echo $post['description']; ?></span></p>
        <p id="text"><strong>$<?php echo $post['price']; ?></strong></p>
    </div>

    <div class="col-md-8">
        <?php if( $this->session->userdata('user_role') == 1):?>
            <a class="btn btn-small btn-warning"  href="<?php $id = $post["Id"]; echo Base_url('posts/editproduct/'.$id); ?>">EDIT PRODUCT</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h3>Comments:</h3>
        <?php if(!empty($comments)): ?>
            <?php foreach($comments as $comment): ?>
                <div >
                    <h5> <?php echo $comment['body']; ?> [by <strong> <?php echo $comment['name']; ?> </strong> on <?php echo $comment['created_on'] ?>] </h5>
                    <?php if($this->session->userdata('id') == $comment['user_id']): ?>
                        <a href="<?php echo site_url('comments/editComment/'.$comment['commentid']); ?>" class="btn btn-warning">EDIT</a>
                        <a href="<?php echo site_url('comments/deleteComment/'.$comment['commentid'].'/'.$post['Id']); ?>" class="btn btn-danger" onclick="return deletefn()">DELETE</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No comments to display</p>
        <?php endif; ?>
        </div>
    </div>
</div>


<div class="container">

<h3>Add Comments:</h3>
<?php 
$attributes=array(
    'method'=>"POST",
    'id'=>"addComment"
  );
echo form_open('comments/createComment',$attributes) ?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php echo form_label('Name'); ?>
            <?php $name=array('placeholder'=>"Name",
                              'id'=>"name");
            echo form_input('name','', $name); ?>
            <div class="errname" style="display:none;color:red">NAME is required</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo form_label('Email'); ?>
            <?php $email=array('placeholder'=>"Email",
                                'id'=>"email");   
            echo form_input('email','', $email); ?>
            <div class="erremail" style="display:none;color:red">EAMIL is required</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo form_label('Body'); ?>
            <?php $comment=array('placeholder'=>"comment",
                                'id'=>"comment",
                                'cols'=>"25",
                                'rows'=>"5");
            echo form_textarea('body','', $comment); ?>
            <input type="hidden" name="productId" value="<?php echo $post['Id']; ?>">
            <div class="errbody" style="display:none;color:red">COMMENT is required</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</div>

<?php echo form_close(); ?>
</div>