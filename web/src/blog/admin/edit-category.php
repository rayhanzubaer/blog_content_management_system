<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if(isset($_GET['e_id'])){
    $e_id = $_GET['e_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_name = $_POST['name'];
        
        $validate = new Validate();
        $validation = $validate->check(array($category_name));
        
        if ($validation->pass()) {
            $sql = "UPDATE category SET name='$category_name' WHERE categoryID='$e_id'";
            $result = DB::getInstance()->insert($sql);

            if ($result) {
                echo "<p class='alert alert-success'>Successful.</p>";    
            }
            else {
                echo "<p class='alert alert-danger'>Failed.</p>";
            }
        }
        else {
            echo "<p class='alert alert-danger'>Failed.</p>";
        }
    }
}
?>
<?php
if (isset($e_id)) {
    $sql = "SELECT name FROM category WHERE categoryID='$e_id';";
    $resource = DB::getInstance()->select($sql);
    
    if ($resource) {
        $value = $resource->fetch_object();
?>
    <h1 class="text-center">Update Category</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Category Name : </label>
            <input type="text" name="name" value="<?php echo $value->name; ?>" placeholder="enter category name" class="form-control">
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="save" value="save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
    }
    else {
        echo '<h2>Page Not Found</h2>';
    }    
}
else {
    echo '<h2>Page Not Found</h2>';
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>