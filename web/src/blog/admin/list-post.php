<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>
<?php

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    $sql = "DELETE FROM post WHERE id=$d_id";
    $result = DB::getInstance()->delete($sql);

    if ($result) {
        $delete_message = '<span class="success">Successful.</span>';
    }
    else {
        $delete_message = '<span class="error">Failed.</span>';    
    }
}

?>
    <h1 class="text-center">Post List</h1>
    <table class="table table-default">
        <tr>
    	    <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publish Date</th>
            <th>Action</th>
        </tr>
<?php
$sql = "SELECT *,category.name FROM post INNER JOIN category ON category.categoryID=post.category ORDER BY id DESC";
$result = DB::getInstance()->select($sql);

if ($result) {
	while ($row = $result->fetch_object()) {	
?>
    	<tr>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->author ;?></td>
            <td><?php echo $row->name ;?></td>
            <td><?php echo formatDate($row->name); ?></td>
            <td><a target="blank" href="view-post.php?v_id=<?php echo $row->id; ?>" title="View"><span class="glyphicon glyphicon-edit"></span></a>
<?php
		if (Session::get('name') == $row->author || (Session::get('user_role') == 'Editor' && Session::get('category') == $row->name)) {
?>
			<a target="blank" href="edit-post.php?e_id=<?php echo $row->id; ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a> 
<?php
		}
		
		if (Session::get('user_role') == 'Admin' || Session::get('name') == $row->author) {
?>                            
		    <a target="blank" onclick="confirm('Are you sure want to delete this item?')" href="list-post.php?d_id=<?php echo $row->id; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
<?php
		} 
?>
                </td>
            </tr>
<?php
	}
}
else {
    echo '<h2>Nothing to preview</h2>';
}
?>
        </table>
	</div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/footer.php';
?>