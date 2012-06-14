<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<form action="<?=site_url('user/login')?>" method="post">
	<h2>Login</h2>
	<section>
		<label>Email</label>
		<input type="email" name="email" required />
	</section>
	<section>
		<label>Password</label>
		<input type="password" name="password" required />
	</section>
	<input type="submit" name="login" value="Login" />
</form>