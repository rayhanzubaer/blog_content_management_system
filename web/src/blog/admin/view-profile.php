<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
    if (isset($_GET['v_id'])) {
        $v_id = $_GET['v_id'];
    }
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $category = $_POST['category'];

    $validate = new Validate();
    $validation = $validate->check(array($role));

    if ($validation->pass()) {
        $sql = "UPDATE user_info SET user_role='$role', category=(IF(user_role='Editor','$category',NULL)) WHERE user_id=$v_id ";
        $update = DB::getInstance()->update($sql);
        
        if ($update) {
            echo "<p class='alert alert-success'>Successful.</p>";
        }
        else{
            echo "<p class='alert alert-danger'>Failed.</p>";
        }
    }
    else{
        echo "<p class='alert alert-danger'>Failed.</p>";
    }
    
}

?>

<?php
if (isset($v_id)) {
    $sql = "SELECT * FROM user_info WHERE user_id='$v_id';";
    $result = DB::getInstance()->select($sql);
    
    if ($result) {
        $user = $result->fetch_object();
?>
    <h1 class="text-center">View Profile</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" name="name" value="<?php echo $user->name; ?>" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="details">Details :</label>
            <textarea name='details' readonly class="form-control">
                <?php echo $user->details; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" name="email" value="<?php echo $user->email; ?>" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" value="<?php echo $user->username; ?>" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Role :</label>
            <select name="role" class="form-control" id="role">
                <option value="">Select Role</option>
                <option value="Admin" <?php if($user->user_role == 'Admin'){ echo 'selected'; } ?> >Admin</option>
                <option value="Author" <?php if($user->user_role == 'Author'){ echo 'selected'; } ?> >Author</option>
                <option value="Editor" <?php if($user->user_role == 'Editor'){ echo 'selected'; } ?> >Editor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category :</label>
            <select name="category" class="form-control">
                <option>Choose Category</option>
<?php

$sql = "SELECT * FROM category";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($row = $result->fetch_object()) {
        echo '<option value="' . $row->name . '">' . $row->name . '</option>';
    }    
}

?>
            </select>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
    }
}
else {
    echo "<h2>404 page not found.</h2>";
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>