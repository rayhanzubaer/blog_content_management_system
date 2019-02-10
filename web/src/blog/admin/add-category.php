<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = sanitize($_POST['name']);

    $validate = new Validate();
    $validation = $validate->check(array($category_name));
    
    if ($validation->pass()) {
        $sql = "INSERT INTO category(name) VALUES ('$category_name')";
        $result = DB::getInstance()->insert($sql);

        if ($result) {
            echo '<p class="alert alert-success">Successful.</p>';    
        }
        else {
            echo '<p class="alert alert-danger">Failed.</p>';
        }
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }
}
?>
    <h1 class="text-center">Create New Category</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Category Name : </label>
            <input type="text" name="name" value="" placeholder="enter category name" class="form-control">
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="save" value="save" class="btn btn-primary btn-lg">
        </div>
    </form>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>