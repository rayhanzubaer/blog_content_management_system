<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
// set social media option
if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];

    $sql = "UPDATE social_media SET used=1 WHERE id=$u_id";

    $result = DB::getInstance()->update($sql);
}
// unset social media option
if (isset($_GET['n_u_id'])) {
    $n_u_id = $_GET['n_u_id'];

    $sql = "UPDATE social_media SET used=0 WHERE id=$n_u_id";

    $result = DB::getInstance()->update($sql);
}
// delete social media option
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    $sql = "DELETE FROM title_description WHERE id='$d_id' AND used<>1";
    $result = DB::getInstance()->delete($sql);

    if ($result) {
        echo "<p class='alert alert-success'>Successfull</p>";
    }
    else {
        echo "<script>alert('cannot delete this. it is currently in use.')</script>";
    }
}
// edit social media option
if (isset($_GET['e_id'])) {
    $e_id = $_GET['e_id'];

    $sql = "SELECT * FROM social_media WHERE id=$e_id";
    $result = DB::getInstance()->select($sql);
    $row = $result->fetch_object();

    if (isset($_POST['update'])) {
        $name = sanitize($_POST['name']);
        $url = sanitize($_POST['url']);
        $icon = sanitize($_FILES['icon']['name']);

        $validate = new Validate(array($name, $url, $icon));
        $validation = $validate->check();

        if ($validation->pass()) {
            $icon_tmp_name = $_FILES['icon']['tmp_name'];
            $icon_directory = 'image/social/' . $icon;
            move_uploaded_file($icon_tmp_name, $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $icon_directory);

            $sql = "UPDATE social_media SET name='$name', url='$url', icon='$icon_directory' WHERE id=$e_id";

            $result = DB::getInstance()->update($sql);

            if ($result) {
                $update_message = '<p class="alert alert-success">Successfull</p>';
            }
            else {
                $update_message = '<p class="alert alert-danger">Failed</p>';
            }    
        }
    }
?>

<?php

    if (isset($update_message)) {
        echo $update_message;
    }

?>
    <h1 class="text-center">Update Social Media</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Social Media Name :</label>
            <input type="text" name="name" value="<?php echo $row->name; ?>" placeholder="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="url">Social Media URL :</label>
            <input type="text" name="url" value="<?php echo $row->url; ?>" placeholder="url" class="form-control">
        </div>
        <div class="form-group">
            <label for="icon">Social Media Icon :</label>
            <input type="file" name="icon">
            <img src="http://localhost/blog/<?php echo $row->icon; ?>">
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="update" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
    
}
// add new social media option
else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = sanitize($_POST['name']);
        $url = sanitize($_POST['url']);
        $icon = sanitize($_FILES['icon']['name']);

        $validate = new Validate();
        $validation = $validate->check(array($name, $url, $icon));

        if ($validation->pass()) {
            $icon_tmp_name = $_FILES['icon']['tmp_name'];
            $icon_directory = 'image/social/' . $icon;
            move_uploaded_file($icon_tmp_name, $_SERVER['DOCUMENT_ROOT'] . '/blog/' . $icon_directory);

            $sql = "INSERT INTO social_media(name, url, icon) VALUES ('$name', '$url', '$icon_directory')";

            $result = DB::getInstance()->insert($sql);

            if ($result) {
                $insert_message = '<p class="alert alert-success">Successfull</p>';
            }
            else {
                $insert_message = '<p class="alert alert-danger">Failed</p>';
            }
        }
        else {
            $insert_message = '<p class="alert alert-danger">Failed</p>';
        }
    }
?>

<?php

    if (isset($insert_message)) {
        echo $insert_message;
    }

?>
    <h1 class="text-center">Social Media</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Social Media Name :</label>
            <input type="text" name="name" value="" placeholder="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="url">Social Media URL :</label>
            <input type="text" name="url" value="" placeholder="url" class="form-control">
        </div>
        <div class="form-group">
            <label for="icon">Social Media Icon :</label>
            <input type="file" name="icon">
        </div>
        <div class="form-group col-md-offset-5">
            <input type="submit" name="update" value="Save" class="btn btn-primary btn-lg">
        </div>
    </form>
<?php
}
?>
    <h1 class="text-center">Available Social Media Preview</h1>
<?php
// view all available social media option
$sql = "SELECT * FROM social_media";
$result = DB::getInstance()->select($sql);

if ($result) {
?>
                <table class="table table-deafult">
                    <tr>
                        <th>Social Media Name</th>
                        <th>Social Media URL</th>
                        <th>Social Media Icon</th>
                        <th>Social Media Status</th>
                        <th>Action</th>
                    </tr>
<?php
    while ($row = $result->fetch_object()) {
?>
                    <tr>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->url; ?></td>
                        <td><img src="<?php echo 'http://localhost/blog/' .$row->icon; ?>" class="img-thumbnail image"></td>
                        <td><?php echo socialMediaStatus($row->used); ?></td>
                        <td>
                            <a href="?u_id=<?php echo $row->id; ?>" title="Use"><span class="glyphicon glyphicon-ok"></span></a>
                            <a href="?n_u_id=<?php echo $row->id; ?>" title="Do Not Use"><span class="glyphicon glyphicon-remove"></span></a>
                            <a href="?e_id=<?php echo $row->id; ?>"  title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="?d_id=<?php echo $row->id; ?>" onclick="confirm('are you sure want to delete.')"  title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
<?php        
    }
}
else {
    echo "<h2>Nothig to Preview</h2>";
}

?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>