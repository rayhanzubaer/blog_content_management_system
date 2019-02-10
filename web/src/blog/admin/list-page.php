<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>
<?php
    if(isset($_GET['d_id'])){
        $d_id = $_GET['d_id'];

        $sql = "DELETE FROM pages WHERE page_id=$d_id";
        $result = DB::getInstance()->delete($sql);

        if ($result) {
            echo "<p class='alert alert-success'>Successful.</p>";    
        }
        else {
            echo "<p class='alert alert-danger'>Failed.</p>";
        }
    }
?>

    <h1 class="text-center">Page List</h1>
    <table class="table table-default">
        <tr>
            <th>Page Name</th>
            <th>Action</th>
        </tr>
<?php
$sql = "SELECT * FROM pages";
$result = DB::getInstance()->select($sql);

if ($result) {
    while($row = $result->fetch_object()) {
?>
        <tr>
            <td><?php echo $row->page_name; ?></td>
            <td>
                <a href="edit-page.php?e_id=<?php echo $row->page_id; ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="return confirm('Are you sure want to delete this item?');" href="list-page.php?d_id=<?php echo $row->page_id; ?>" title="Delete" ><span class="glyphicon glyphicon-trash"></a>
            </td>
        </tr>
<?php
    }
}
?>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>