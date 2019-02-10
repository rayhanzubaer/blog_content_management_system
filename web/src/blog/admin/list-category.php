<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    $sql = "DELETE FROM category WHERE categoryID=$d_id";
    $result = DB::getInstance()->delete($sql);

    if ($result) {
        echo '<p class="alert alert-success">Successful.</p>';    
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }
}
?>
    <h1 class="text-center">Category List</h1>
    <table class="table table-default">
        <tr>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
<?php

$sql = "SELECT * FROM category;";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($value = $result->fetch_object()) {
?>
        <tr>
            <td><?php echo $value->name; ?></td>
            <td><a href="edit-category.php?e_id=<?php echo $value->categoryID; ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="return confirm('Are you sure want to delete this item?');" href="list-category.php?d_id=<?php echo $value->categoryID; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
<?php
    }
}
else {
    echo '<h2>Nothing to preview.</h2>';
}
?>
    </table>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>