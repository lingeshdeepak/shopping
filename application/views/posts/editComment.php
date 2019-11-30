<h3>Edit Comments:</h3>

<?php echo validation_errors(); ?>  

<?php 
$attributes=array(
    'method'=>"POST",
    'id'=>"editComment"
  );
echo form_open('comments/updateComment',$attributes) ?>

    <div class="container">
        <div class="row">
           <div class="col-md-2">
            <?php echo form_label('Name'); ?>
           </div>
           
            <div class="col-md-4">
                <?php 
                $name = array(
                    'id' => 'name',
                    'name' => 'name',
                    'value' => $post['name']
                );
                echo form_input($name); 
                ?>
            </div>
           <div class='errname' style='display:none;color:red;size:8px'>name is required</div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?php echo form_label('Email'); ?>
            </div>
          
            <div class="col-md-4">
                <?php 
                $email = array(
                    'id' => 'email',
                    'name' => 'email',
                    'value' => $post['email']
                );
                echo form_input($email); ?>
            </div>
            <div class='erremail' style='display:none;color:red;size:8px'>email is required</div>
        </div>

        <div class="row">
        <div class="col-md-2">
            <?php echo form_label('Body'); ?>   
        </div>
           
        <div class="col-md-4">
        <?php 
            $comment = array(
                'id' => 'comment',
                'name' => 'body',
                'value' => $post['body']
            );
            echo form_textarea($comment); ?>
        </div> 
            <div class='errbody' style='display:none;color:red;size:8px'>Comment is required</div>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="<?php echo base_url()?>posts/viewdetails/<?php echo $post['productId']; ?>" class="btn btn-info">Back</a>

        <input type="hidden" name="productId" value="<?php echo $post['productId']; ?>">
        <input type="hidden" name="commentId" value="<?php echo $post['commentid']; ?>">

    </div>
<?php echo form_close(); ?> 