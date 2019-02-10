<?php include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php' ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = sanitize($_POST['theme']);

    $validate = new Validate();
    $validation = $validate->check(array($theme));

    if ($validation->pass()) {
        $sql = "UPDATE theme SET status=(IF(id='$theme',1,0))";
        $update = DB::getInstance()->update($sql);

        if ($update) {
            echo '<p class="alert alert-success">Successful.</p>';
        }
        else {
            echo '<p class="alert alert-danger">Failed.</p>';    
        }
    }
    else {
        echo '<p class="alert alert-danger">select a theme.</p>';
    }
}

?> 

<form action="" method="POST">
    <div class="form-group">
        <label for="theme">Select Theme</label>
<?php
$sql = "SELECT * FROM theme";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($row = $result->fetch_object()) {
        echo '<input type="radio" name="theme" value="' . $row->id . '">' . $row->name;
    }
}
?>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg">
    </div>
</form>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php' ?>
