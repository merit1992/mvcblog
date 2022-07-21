<nav class="top-nav">
	<ul>
		<li><a href="<?php echo URLROOT. '/pages/index'?>">Home</a></li>

		<li><a href="<?php echo URLROOT. '/pages/about'?>">About Us</a></li>

		<li><a href="<?php echo URLROOT. '/pages/contact'?>">Contact</a></li>

		<li><a href="<?php echo URLROOT. '/posts/index'?>">Blog</a></li>
			<li><a class="login"
				<?php if (isset($_SESSION['user_id'])) :?>
				 href="<?php echo URLROOT. '/users/logout'?>">Logout</a></li>
				<?php else :?>
				 href="<?php echo URLROOT. '/users/login'?>">Login</a></li>
				<?php endif; ?>
	</ul>
</nav>