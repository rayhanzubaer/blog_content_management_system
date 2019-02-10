<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>
        <div class="content">
            <h2>Edit Page</h2>
<?php
if (isset($_GET['e_id'])) {
    $e_id = $_GET['e_id'];
}
else {
    echo '<h2>404 page not found.</h2>';
}
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $page_name = sanitize($_POST['page_name']);
        $page_content = sanitize($_POST['page_content']);

        $validate = new Validate();
        $validation = $validate->check(array($page_name, $page_content));

        if ($validation->pass()) {
            $sql = "UPDATE pages SET page_name='$page_name',page_content='$page_content' WHERE page_id=$e_id";
            $result = DB::getInstance()->update($sql);

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

<?php
    if (isset($e_id)) {
        $sql = "SELECT * FROM pages WHERE page_id=$e_id";
        $result = DB::getInstance()->select($sql);

        if ($result) {
            $row = $result->fetch_object();
?>
    <h1 class="text-center">Edit Page</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="page_name">Menu Name :</label>
            <input type="text" name="page_name" value="<?php echo $row->page_name; ?>" placeholder="Menu Name" class="form-control">
        </div>
        <div class="form-group">
            <label for="page_content">Menu Content :</label>
            <textarea name='page_content' placeholder="enter menu content" class="form-control">
                <?php echo $row->page_content; ?>
            </textarea>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
        }
    }
?>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>