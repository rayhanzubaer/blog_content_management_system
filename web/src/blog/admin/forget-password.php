<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $validate = new Validate();
    $validation = $validate->check(array($email));

    if ($validation->pass()) {
        $sql = "SELECT email FROM user_info WHERE email='$email'";
        $result = DB::getInstance()->select($sql);

        if ($result) {
            $to = $email;
            $subject = 'Password Recovery';
            $message = 'New Password is : 1234567890';

            if (mail($to, $subject, $message)) {
                echo '<p class="alert alert-succes">password sent check you email.</p>';    
            }
            else {
                echo '<p class="alert alert-danger">some error occured.</p>';
            }
        }
        else {
            echo '<p class="alert alert-danger">email does not match.</p>';    
        }
    }
    else {
        echo '<p class="alert alert-danger">email is required.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link type="text/css" rel="stylesheet" href="resources/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-offset-4 col-md-4">
            <h1 class="text-center">Recover Password</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="" placeholder="enter email" class="form-control"/>
                </div>
                <div class="form-group col-md-offset-5">
                    <input type="submit" name="change_password" value="Send" class="btn btn-primary btn-lg"/>
                </div>
            </form>
            <p>A recovery password will be sent to your email.</p>
        </div>
    </div>
    <script type="text/javascript" src="resources/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="resources/js/bootstrap.js"></script>
</body>
</html>