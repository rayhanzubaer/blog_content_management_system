<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/admin/include/sidebar.php';
?>

<?php

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    $sql = "DELETE FROM user_info WHERE user_id=$d_id";
    $delete = DB::getInstance()->delete($sql);

    if ($delete) {
        echo '<p class="alert alert-success">Successful.</p>';
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }
}

if (isset($_GET['approve_id'])) {
    $user_id = $_GET['approve_id'];
    $sql = "UPDATE user_info SET status='approve' WHERE user_id=$user_id";
    $status = DB::getInstance()->update($sql);

    if ($status) {
        echo '<p class="alert alert-success">Successful.</p>';
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }   
}

if (isset($_GET['reject_id'])) {
    $user_id = $_GET['reject_id'];
    $sql = "UPDATE user_info SET status='pending' WHERE user_id=$user_id";
    $status = DB::getInstance()->update($sql);

    if ($status) {
        echo '<p class="alert alert-success">Successful.</p>';
    }
    else {
        echo '<p class="alert alert-danger">Failed.</p>';
    }   
}
?>
    <table class="table table-default">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Approval</th>
            <th>Action Status</th>
        </tr>
<?php

$sql = "SELECT * FROM user_info";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($value = $result->fetch_object()) {    

?>
        <tr>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->username; ?></td>
            <td><?php echo $value->user_role; ?></td>
            <td><?php echo $value->status; ?></td>
            <td>
                <a href="?approve_id=<?php echo $value->user_id;?>" title="Approve"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="?reject_id=<?php echo $value->user_id;?>" title="Reject"><span class="glyphicon glyphicon-minus"></span></a>
                <a href="view-profile.php?v_id=<?php echo $value->user_id;?>" title="View"><span class="glyphicon glyphicon-edit"></span></a>
<?php
    if (Session::get('user_role') == 'Admin') {
?>
                <a onclick="confirm('Are you sure want to delete this item?');" href="list-user.php?d_id=<?php echo $value->user_id; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
<?php
    } 
?>
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