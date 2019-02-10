<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    $sql = "DELETE FROM contact WHERE id=$d_id";
    $result = DB::getInstance()->delete($sql);

    if ($result) {
        echo "<p class='alert alert-success'>Successful.</p>";    
    }
    else {
        echo "<p class='alert alert-danger'>Failed.</p>";
    }
}
?>
    <h1 class="text-center">Inbox</h1>
    <table class="table table-default">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Action</th>
        </tr>
<?php

$sql = "SELECT * FROM contact;";
$result = DB::getInstance()->select($sql);

if ($result) {
	while ($value = $result->fetch_object()) {
?>
        <tr>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->subject; ?></td>
            <td>
                <a href="view.php?v_id=<?php echo $value->id; ?>" title="View"><span class="glyphicon glyphicon-edit"></span></a>
                <a href="reply.php?r_id=<?php echo $value->id;?>" title="Reply"><span class="glyphicon glyphicon-pencil"></span></a>
                <a onclick="confirm('Are you sure want to delete this item?');" href="inbox.php?d_id=<?php echo $value->id; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
               </td>
        </tr>
<?php
	}
}
?>
            </table>
        </div>
	</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>