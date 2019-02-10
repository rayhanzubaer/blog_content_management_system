<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>
<?php
// set website title description logo
if (isset($_GET['title_id'])) {
    $title_id = $_GET['title_id'];

    $sql = "UPDATE title_description SET used=(IF(id='$title_id', 1, 0))";

    $result = DB::getInstance()->update($sql);

    if ($result) {
        echo '<p class="alert alert-success">Successfull</p>';
    }
    else {
        echo '<p class="alert alert-danger">Failed</p>';
    }
}
// delete website title description logo
if (isset($_GET['del_title_id'])) {
    $del_title_id = $_GET['del_title_id'];

    $sql = "DELETE FROM title_description WHERE id='$del_title_id' AND used<>1";
    $result = DB::getInstance()->delete($sql);

    if ($result) {
        echo '<p class="alert alert-success">Successfull</p>';
    }
    else {
        echo '<p class="alert alert-danger">Failed</p>';
    }
}

?>
<?php
// add new website title description logo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $logo = sanitize($_FILES['image']['name']);

    $validate = new Validate();
    $validation = $validate->check(array($title, $description, $logo));

    if ($validation->pass()) {
        $logo_tmp_name = $_FILES['image']['tmp_name'];
        $logo_directory = 'image/logo/' . $logo;
        move_uploaded_file($logo_tmp_name, $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $logo_directory);

        $sql = "INSERT INTO title_description(title, description, logo) VALUES ('$title', '$description', '$logo_directory')";

        $result = DB::getInstance()->insert($sql);

        if ($result) {
            echo '<p class="alert alert-success">Insert Successfull</p>';
        }
        else {
            echo '<p class="alert alert-danger">Insert Failed</p>';
        }
    }
    else {
        echo '<p class="alert alert-danger">Insert Failed</p>';
    }
}

?>
<!--content-->
    <!--Website Title Description Logo-->
    <h1 class="text-center">Website Title Description Logo</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Website Title :</label>
            <input type="text" name="title" value="" placeholder="enter website title" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="description">Website Description :</label>
            <input type="text" name="description" value="" placeholder="enter website description" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="image">Choose Website Logo :</label>
            <input type="file" name="image"/>
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="save" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
    <!--Website Title Description Logo Preview-->
    <h1 class="text-center">Website Title Description Logo Preview</h1>
    <table class="table table-default">
        <tr>
            <th>Website Title</th>
            <th>Website Description</th>
            <th>Website Logo</th>
            <th>Action</th>
        </tr>
<?php
// view all available website title description logo
$sql = "SELECT * FROM title_description";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($row = $result->fetch_object()) {
?>
        <tr>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->description; ?></td>
            <td><img src="<?php echo 'http://localhost/blog/' .$row->logo; ?>" class="img-thumbnail image"></td>
            <td><a href="?title_id=<?php echo $row->id; ?>" title="use"><span class="glyphicon glyphicon-edit"></span></a> <a href="?del_title_id=<?php echo $row->id; ?>" onclick="confirm('are you sure want to delete.')" title="delete"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
<?php        
    }
}
else {
    echo "<h3>Nothig to Preview</h3>";
}

?>
    </table>
<!--content-->

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>