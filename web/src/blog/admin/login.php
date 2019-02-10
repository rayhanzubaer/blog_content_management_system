<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php'; ?>

<?php

if (Session::exists('message')) {
	echo Session::get('message');
	Session::set('message', null);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = sanitize($_POST['username']);
	$password = sanitize($_POST['password']);

	$validate = new Validate();
	$validation = $validate->check(array($username, $password));

	if ($validation->pass()) {
		$sql = "SELECT * FROM user_info WHERE username='$username' AND password='$password'";
		$result = DB::getInstance()->select($sql);

		if ($result) {
			$user = $result->fetch_object();
			
			if ($user->status === 'approve') {
				Session::set('login', true);
				Session::set('user_id', $user->user_id);
				Session::set('name', $user->name);
				Session::set('username', $user->username);
				Session::set('user_role', $user->user_role);
				Session::set('category', $user->category);

				redirectTo('index.php');	
			}
			else {
				$error_message = '<p class="alert alert-danger">you are not an approved user.</p>';
			}
		}
		else {
			$error_message = '<p class="alert alert-danger">username or password is incorrect.</p>';
		}
	}
	else {
		$error_message = '<p class="alert alert-danger">username and password is required.</p>';
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name='viewport' content="width=device-width, initial-scale=1.0">
	<title>Become A Blogger-Login</title>
	<link type="text/css" rel="stylesheet" href="resources/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="resources/css/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-offset-4 col-md-4">
			<h1 class="text-center">Log in</h1>
<?php
if (isset($error_message)) {
	echo $error_message;
}
?>
			<form action="" method="POST">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" value="" placeholder="enter username" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" value="" placeholder="enter password" class="form-control"/>
				</div>
				<div class="form-group">
					<p><a href="register.php">not a member register now</a></p>
					<p><a href="forget-password.php">forget password</a></p>
				</div>
				<div class="form-group col-md-offset-5">
					<input type="submit" name="register" value="Log in" class="btn btn-primary btn-lg"/>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="resources/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="resources/js/bootstrap.js"></script>
</body>
</html>