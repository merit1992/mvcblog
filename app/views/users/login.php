<?php
require APPROOT. '/views/includes/head.php';
?>
<div class="login-nav">
	<?php
	require APPROOT. '/views/includes/navigation.php';
	?>
</div>
	<div class="section">
		<h2>Login here</h2>
		<div class="section-wrapper">
			<form method="post" action="<?php echo URLROOT. '/users/login'?>">
				<input type="text" name="email/username" placeholder="Email/Username *">
				<span class="error-message">
					<?php echo $data['email/usernameError'];?>
				</span>

				<input type="password" name="password" placeholder="Password *">
				<span class="error-message">
					<?php echo $data['passwordError'];?>
				</span>

				<button type="submit" name="submit" value="submit">Login</button>
			</form>

			<p class="option">Don't have an account? <a href="<?php echo URLROOT. '/users/register';?>"> Register here</a></p>
		</div>
	</div>