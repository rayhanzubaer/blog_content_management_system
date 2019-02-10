<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = sanitize($_POST['old_password']);
    $new_password = sanitize($_POST['new_password']);
    $password_again = sanitize($_POST['password_again']);
    $username = Session::get('username');

    $validate = new Validate();
    $validation = $validate->check(array($old_password, $new_password, $password_again));
    
    if ($validation->pass()) {
        $sql = "SELECT * FROM user_info WHERE username='$username' AND password='$old_password'";
        $result = DB::getInstance()->select($sql);

        if ($result) {
            if ($new_password === $password_again) {
                $sql = "UPDATE user_info SET password='$new_password' WHERE username='$username'";
                $result = DB::getInstance()->update($sql);

                if ($result) {
                    echo '<p class="alert alert-success">Successful.</p>';
                }
                else {
                    echo '<p class="alert alert-danger">Failed.</p>';
                }  
            }
            else {
                echo '<p class="alert alert-danger">password did not match.</p>';
            }    
        }
        else {
            echo '<p class="alert alert-danger">your old password is wrong.</p>';
        }
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }
}
?>
    <h1 class="text-center">Change Password for <a href="user-profile.php"><?php echo Session::get('username'); ?></a></h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="old_password">Old Password : </label>
            <input type="password" name="old_password" value="" placeholder="enter old password" class="form-control">
        </div>
        <div class="form-group">
            <label for="new_password">New Password : </label>
            <input type="password" name="new_password" value="" placeholder="enter new password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_again">Re-type new Password : </label>
            <input type="password" name="password_again" value="" placeholder="re-enter new password" class="form-control">
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Change Password" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>