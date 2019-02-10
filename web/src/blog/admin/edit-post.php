<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php

if (isset($_GET['e_id'])) {
    $e_id = $_GET['e_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = sanitize($_POST['title']);
        $category = sanitize($_POST['category']);
        $content = sanitize($_POST['content']);
        $author = sanitize($_POST['author']);
        $last_modified_by = Session::get('name');

        $validate = new Validate();
        $validation = $validate->check(array($title, $content));

        if ($validation->pass()) {
            $sql = "UPDATE post SET title='$title', content='$content', last_modified_by = '$last_modified_by' WHERE id='$e_id'";
            $result = DB::getInstance()->update($sql);

            if ($result) {
                echo '<p class="alert alert-success">Successful.</p>';    
            }
            else {
                echo '<p class="alert alert-danger">Failed.</p>';
            }
        }
        else {
            echo '<p class="alert alert-danger">Validation Failed.</p>';
        }
    }
}

?>
<?php
if (isset($e_id)) {
    $sql = "SELECT * FROM post WHERE id=$e_id";
    $result = DB::getInstance()->select($sql);

    if ($result) {
        $post = $result->fetch_object();
?>
    <h1 class="text-center">Update Post</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="category">Category :</label>
            <select name="category" class="form-control" disabled>
<?php

$sql = "SELECT * FROM category";
$result = DB::getInstance()->select($sql);

if ($result) {
    while($value = $result->fetch_object()) {
        $selected = ($value->categoryID==$post->category) ? 'selected' : '';

        echo '<option value="' . $value->categoryID . '"' . $selected . '>' . $value->name . '</option>';
    }
}

?>
            </select>    
        </div>
        <div class="form-group">
            <label for="content">Content :</label>
            <textarea name='content' class="form-control">
                <?php echo $post->content; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="author">Author :</label>
            <input type="text" name="author" value="<?php echo $post->author; ?>" class="form-control" disabled>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
    }
}
else {
    echo "<h2>Page Not Found.</h2>";
}

?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>