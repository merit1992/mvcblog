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
        input your post here
    </h1>
    <form action="<?php echo URLROOT. '/posts/create'?>" method="post">
        <div class="form-control">
            <input type="text" name="title" placeholder="Tilte of your post...">
            <br>
            <span class="error-message">
                <?php echo $data['titleError'];?>
            </span>
        </div>
        <div class="form-control">
            <textarea name="body" placeholder="body of your post...."></textarea>
            <br>
            <span class="error-message">
                <?php echo $data['bodyError'];?>
            </span>
        </div>
        <button class="btn green" name="submit" type="submit" >Submit</button>
    </form>
        
</div>