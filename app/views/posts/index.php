<?php
	require APPROOT . '/views/includes/head.php';
?>
<div class="login-nav">
	<?php
	require APPROOT. '/views/includes/navigation.php';
	?>
</div>
<div class="container wrapper">
    <?php if (isLoggedin()):?>
        <a class="create" href="<?php echo URLROOT. '/posts/create'?>">
            create
        </a>
    <?php endif;?>
    <?php foreach ($data['post'] as $post): ?> 
        <div class="container-item">
            
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id):?>
                <form action="<?php echo URLROOT. '/posts/delete/'. $post->id?>" method="post">
                    <input class="delete"  type="submit" name="submit" value="delete">
                 </form>
                <a class="update" href="<?php echo URLROOT. '/posts/update/'.$post->id?>">
                    update
                </a>
            <?php endif;?>
                <h2>
                <?php echo $post->post_title?>
            </h2>
            <h3>
               <?php echo "Created at ". date('F j h:m', strtotime($post->post_date))?>
            </h3>
            <p>
                <?php echo $post->post_body?>
            </p>
        </div>
    <?php endforeach;?>
</div>