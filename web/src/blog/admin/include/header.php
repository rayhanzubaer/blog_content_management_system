<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php';  ?>
<?php

if (Session::get('login') !== true) {
	redirectTo('login.php');
}

?>
<?php

$sql = "SELECT * FROM title_description WHERE used=1";
$result = DB::getInstance()->select($sql);

if ($result) {
  $row = $result->fetch_object();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="resources/css/bootstrap.css">
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
<!--header-->
	<nav class="navbar navbar-default menu">
  		<div class="container-fluid">
    		<div class="navbar-header" id="header">
      			<a class="navbar-brand" href="#">
      				<img src="http://localhost/blog/<?php echo $row->logo; ?>" class="img-rounded" alt="logo">
      				<h1><?php echo $row->title; ?></h1>
      				<p><?php echo $row->description; ?></p>
      			</a>
    		</div>
    		<ul class="nav navbar-nav navbar-right">
    			<li><img src="http://localhost/blog/image/default.jpeg" alt="image" class="img-circle"></li>
      			<li><a href="user-profile.php"><?php echo Session::get('name'); ?></a></li>
      			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      				<span class="caret"></span></a>
        			<ul class="dropdown-menu">
          				<li><a href="change-password.php">Change password</a></li>
          				<li><a href="logout.php">log out</a></li>
        			</ul>
      			</li>
    		</ul>
  		</div>
	</nav>
<!--header-->
<!--main content-->
	<div class="container-fluid display-table">
		<div class="row display-table-row">