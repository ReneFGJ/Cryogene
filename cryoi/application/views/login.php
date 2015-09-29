<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<title>Log-in</title>
		<link rel="stylesheet" href="<?php echo base_url('css/style_login.css');?>">
	</head>
	<body>
		<div class="login-card">
			<h1>Log-in Administrativo</h1>
			<br>
			<form method="post" action="<?php echo base_url('index.php/main/login');?>">
				<input type="text" name="user" placeholder="Username">
				<input type="password" name="pass" placeholder="Password">
				<input type="submit" name="login" class="login login-submit" value="login">
			</form>

		</div>
	</body>
</html>
