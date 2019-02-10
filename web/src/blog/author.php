<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/header.php';
?>
<div id="page" class="overflow">
    <div id="content" class="overflow">
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM user_info WHERE name='$id';";
    $result = DB::getInstance()->select($sql);
    
    if ($result) {
        $user = $result->fetch_object();
?>
    <h1 class="text-center">View Profile</h1>
        <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" name="name" value="<?php echo $user->name; ?>" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="details">Details :</label>
            <textarea name='details' readonly class="form-control">
                <?php echo $user->details; ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" name="email" value="<?php echo $user->email; ?>" readonly class="form-control">
        </div>
<?php
    }
}
else {
    echo "<h2>404 page not found.</h2>";
}
?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/sidebar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/footer.php';
?>