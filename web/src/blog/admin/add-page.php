<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $page_name = sanitize($_POST['page_name']);
    $page_content = sanitize($_POST['page_content']);

    $validate = new Validate();
    $validation = $validate->check(array($page_name, $page_content));

    if ($validation->pass()) {
        $sql = "INSERT INTO pages(page_name,page_content) VALUES ('$page_name','$page_content')";
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
?>
    <h1 class="text-center">Create New Page</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="page_name">Menu Name :</label>
            <input type="text" name="page_name" placeholder="Menu Name" class="form-control">
        </div>
        <div class="form-group">
            <label for="page_content">Menu Content :</label>
            <textarea name='page_content' placeholder="enter menu content" class="form-control" "></textarea>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>