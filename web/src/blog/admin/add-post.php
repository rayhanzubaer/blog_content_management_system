<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitize($_POST['title']);
    $category = sanitize($_POST['category']);
    $image = sanitize($_FILES['image']['name']);
    $content = sanitize($_POST['content']);
    $author = sanitize($_POST['author']);

    $validate = new Validate();
    $validation = $validate->check(array($title, $category, $image, $content, $author));

    if ($validation->pass()) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_directory = 'image/upload/' . $image;
        
        move_uploaded_file($image_tmp_name, $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $image_directory);

        $sql = "INSERT INTO post(category,title,content,image,author,month_year,year) VALUES ('$category','$title','$content','$image_directory','$author',DATE_FORMAT(NOW(),'%Y-%m'),DATE_FORMAT(NOW(),'%Y'))";
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
    <h1 class="text-center">Create New post</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title :</label>
            <input type="text" name="title" placeholder="enter post title" class="form-control">
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
        echo '<option value="' . $row->categoryID . '">' . $row->name . '</option>';

    }    
}

?>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="content">Content :</label>
            <textarea name='content' class="form-control" placeholder="enter post content"></textarea>
        </div>
        <div class="form-group">
            <label for="author">Author :</label>
            <input type="text" name="author" value="<?php echo Session::get('name'); ?>" readonly class="form-control" >
        </div>
        <div class=" col-md-offset-5 form-group">
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>