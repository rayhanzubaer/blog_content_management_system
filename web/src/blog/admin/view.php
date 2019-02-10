<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>
    
<?php

if (isset($_GET['v_id'])) {
    $v_id = $_GET['v_id'];

    $sql = "SELECT * FROM contact WHERE id='$v_id';";
    $result = DB::getInstance()->select($sql);

    if ($result) {
        $row = $result->fetch_object();
?>
    <h1 class="text-center">View Message</h1>
    <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" name="name" value="<?php echo $row->name; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="text" name="email" value="<?php echo $row->email; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="subject">Subject :</label>
        <input type="text" name="subject" value="<?php echo $row->subject; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">Message :</label>
        <textarea name="message" class="form-control">
            <?php echo $row->message; ?>
        </textarea>
    </div>
<?php
    }
    else {
        echo '<h2>nothing to preview.</h2>';
    }       
}
else {
    echo '<h2>404 page not found.</h2>';
}
?>    

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>