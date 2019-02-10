<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $email = sanitize($_POST['email']);
    $details = sanitize($_POST['details']);
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $password_again = sanitize($_POST['password_again']);

    $validate = new Validate();
    $validation = $validate->check(array($first_name, $last_name, $email, $details, $username, $password, $password_again));

    if ($validation->pass()) {
        if ($password === $password_again) {
        	$name = $first_name . ' ' . $last_name;

        	$sql = "INSERT INTO user_info(name,email,details,username,password) VALUES ('$name','$email','$details','$username','$password')";
        	
        	$result = DB::getInstance()->insert($sql);

        	if ($result) {
            	Session::set('message', '<p class="alert alert-success">Registered Successfully.</p>');
            	redirectTo('login.php');    
        	}
        	else {
            	$msg = '<p class="alert alert-danger">Failed.</p>';
        	}
        }
        else {
        	$msg = '<p class="alert alert-danger">Password must match.</p>';	
        }
    }
    else {
        $msg = '<p class="alert alert-danger">Fields cannot be empty.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name='viewport' content="width=device-width, initial-scale=1.0">
	<title>Become A Blogger-Register</title>
	<link type="text/css" rel="stylesheet" href="resources/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="resources/css/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-offset-4 col-md-5">
			<h1 class="text-center">Register</h1>
<?php
if (isset($msg)) {
	echo $msg;
}
?>
			<form action="" method="POST">
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" value="" placeholder="enter first name" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" value="" placeholder="enter last name" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" value="" placeholder="enter email" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="details">Details</label>
					<textarea name="details" placeholder="describe yourself" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" value="" placeholder="enter username" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" value="" placeholder="enter password" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password_again">Confirm Password</label>
					<input type="password" name="password_again" value="" placeholder="enter password again" class="form-control"/>
				</div>
				<div class="form-group col-md-offset-5">
					<input type="submit" name="register" value="Register" class="btn btn-primary btn-lg"/>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="resources/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="resources/js/bootstrap.js"></script>
</body>
</html>