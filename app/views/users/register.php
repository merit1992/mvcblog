<?php
require APPROOT. '/views/includes/head.php';
?>
<div class="login-nav">
	<?php
	require APPROOT. '/views/includes/navigation.php';
	?>
</div>
	<div class="section">
		<h2>Register here</h2>
		<div class="section-wrapper">
			<form method="post" action="<?php echo URLROOT. '/users/register'?>">
				<input type="text" name="username" placeholder="Username *">
				<span class="error-message">
					<?php echo $data['usernameError'];?>
				</span>

				<input type="email" name="email" placeholder="Email *">
				<span class="error-message">
					<?php echo $data['emailError'];?>
				</span>

				<input type="password" name="password" placeholder="Password *">
				<span class="error-message">
					<?php echo $data['passwordError'];?>
				</span>

				<input type="password" name="confirmPassword" placeholder="confirmPassword *">
				<span class="error-message">
					<?php echo $data['confirmPasswordError'];?>
				</span>

				<button type="submit" name="submit" value="submit">Register</button>
			</form>
		</div>
	</div>