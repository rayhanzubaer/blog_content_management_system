<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php

if (isset($_GET['v_id'])) {
    $v_id = $_GET['v_id'];

    $sql = "SELECT * FROM post WHERE id=$v_id";
    $result = DB::getInstance()->select($sql);

    if ($result) {
        $post = $result->fetch_object();
?>
    <div class="form-group">
        <label for="title">Title :</label>
        <input type="text" name="title" value="<?php echo $post->title; ?>" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="category">Category :</label>
        <select name="category" class="form-control">
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
        <label for="image">Image :</label>
        <img src="<?php echo 'http://localhost/blog/'.$post->image; ?>" class="img-rounded">
    </div>
    <div class="form-group">
        <label for="content">Content :</label>
        <textarea name='content' class="form-control" readonly>
            <?php echo $post->content; ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="author">Author :</label>
        <input type="text" name="author" value="<?php echo $post->author; ?>" class="form-control" readonly>
    </div>
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