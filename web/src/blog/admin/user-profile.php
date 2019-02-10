<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
$user_id = Session::get('user_id');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $details = sanitize($_POST['details']);
    $email = sanitize($_POST['email']);
    $username = sanitize($_POST['username']);

    $validate = new Validate();
    $validation = $validate->check(array($name, $details, $email, $username));

    if ($validation->pass()) {
        $sql = "UPDATE user_info SET name='$name',details='$details',email='$email',username='$username' WHERE user_id = '$user_id'";
        $update = DB::getInstance()->update($sql);
        
        if($update){
            echo '<p class="alert alert-success">Successful.</p>';
        }
        else{
            echo '<p class="alert alert-danger">Failed.</p>';
        }
    }
    else{
        echo '<p class="alert alert-danger">Failed.</p>';
    }
}

?>

<?php
$sql = "SELECT * FROM user_info WHERE user_id='$user_id';";
$result = DB::getInstance()->select($sql);

if ($result) {
    $user = $result->fetch_object();
?>
    <h1 class="text-center">User Profile</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" name="name" value="<?php echo $user->name; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="details">Details :</label>
            <textarea name='details' class="form-control">
                <?php echo $user->details; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Role :</label>
            <select name="role" class="form-control">
                <option>Select Role</option>
                <option value="Admin" <?php if($user->user_role == 'Admin'){ echo 'selected'; } ?> >Admin</option>
                <option value="Author" <?php if($user->user_role =='Author'){ echo 'selected'; } ?> >Author</option>
                <option value="Editor" <?php if($user->user_role == 'Editor'){ echo 'selected'; } ?> >Editor</option>
            </select>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg">    
        </div>
    </form>
<?php
}
else {
    echo '<h2>Something went wrong.</h2>';
}
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>