<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Install DeadSimple!</title>
		<link href="../Themes/default/css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container">
			<h2>Install Dead Simple</h2>
			<form action="" method="post">
				<section>
					<label>Site URL</label>
					<input type="text" name="url" value="" />
				</section>

				<h3>Database Connection Information</h3>
				<section>
					<label>Database User</label>
					<input type="text" name="db_user" value="" />
				</section>
				<section>
					<label>Database Password</label>
					<input type="text" name="db_pass" value="" />
				</section>
				<section>
					<label>Database Name</label>
					<input type="text" name="db_name" value="" />
				</section>
				<section>
					<label>Database Host</label>
					<input type="text" name="db_host" value="localhost" />
				</section>

				<h3>User Information</h3>
				<section>
					<label>Email</label>
					<input type="text" name="email" value="" />
				</section>
				<section>
					<label>Password</label>
					<input type="password" name="password" value="" />
				</section>

				<input type="submit" name="install" value="Install" />

			</form>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
		// Check Install Details
		$('input[type="submit"]').click(function(e) {
			e.preventDefault();

			// Check Details
			$.ajax({
				url : 'index.php?check',
				data : $('form').serialize(),
				type : 'POST',
				success : function(data) {
					if (data.length === 0) {
						$('form').submit();
					} else {
						$('.container').prepend(data);
					}
				}
			})
			

		});
		</script>
	</body>
</html>