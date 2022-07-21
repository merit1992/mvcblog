<?php
	require APPROOT . '/views/includes/head.php';
?>
<div class="login-nav">
	<?php
	require APPROOT. '/views/includes/navigation.php';
	?>
</div>
    <?php if(!isLoggedin()):?>
        <?php header('location:'.URLROOT.'/posts/index')?>
    <?php endif;?>
<div class="container center">
    <h1>
        update your post
    </h1>
    <form action="<?php echo URLROOT. '/posts/update/'. $data['post']->id?>" method="post">
        <div class="form-control">
            <input 
            type="text" 
            name="title" 
            value="<?php echo $data['post']->post_title?>">
            <br>
            <span class="error-message">
                <?php echo $data['titleError'];?>
            </span>
        </div>
        <div class="form-control">
            <textarea name="body"><?php echo $data['post']->post_body?></textarea>
            <br>
            <span class="error-message">
                <?php echo $data['bodyError'];?>
            </span>
        </div>
        <button class="btn green" name="submit" type="submit" >update</button>
    </form>
        
</div>