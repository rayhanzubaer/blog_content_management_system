<!--sidebar-->
            <div class="col-md-2 display-table-cell" id="side-menu">
                <div class="side-menu-content">
                    <div class="hover">
                        <a href="index.php"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>Dashboard</a>
                    </div>
<?php
if (Session::get('user_role') === 'Admin') {
?>
                    <div class="hover" onclick="accordion(3)">
                        <a><span class="glyphicon glyphicon-home"></span>Apperance</a>
                    </div>
                    <div>
                        <div class="collapse">
                            <div class="hover"><a href="title-description.php"><span class="glyphicon glyphicon-film"></span>Title &amp; Description</a></div>
                            <div class="hover"><a href="social-media.php"><span class="glyphicon glyphicon-picture"></span>Social Media</a></div>
                            <div class="hover"><a href="theme.php"><span class="glyphicon glyphicon-picture"></span>Theme</a></div>
                        </div>
                    </div>
                    <div class="hover" onclick="accordion(2)">
                        <a><span class="glyphicon glyphicon-check"></span>Manage Page</a>
                    </div>
                    <div>
                        <div class="collapse">
                            <div class="hover"><a href="add-page.php"><span class="glyphicon glyphicon-pencil"></span>Create Page</a></div>
                            <div class="hover"><a href="list-page.php"><span class="glyphicon glyphicon-list-alt"></span>View Page</a></div>
                        </div>
                    </div>
                    <div class="hover" onclick="accordion(1)">
                        <a><span class="glyphicon glyphicon-check"></span>Manage Category</a>
                    </div>
                    <div>
                        <div class="collapse">
                            <div class="hover"><a href="add-category.php"><span class="glyphicon glyphicon-pencil"></span>Create Category</a></div>
                            <div class="hover"><a href="list-category.php"><span class="glyphicon glyphicon-list-alt"></span>View Category</a></div>
                        </div>
                    </div>
<?php
}
?>
                    <div class="hover" onclick="accordion(0)">
                        <a><span class="glyphicon glyphicon-scale"></span>Manage Post</a>
                    </div>
                    <div>
                        <div class="collapse">
<?php
                                if (Session::get('user_role') !== 'Editor') {
                                    echo '<div class="hover"><a href="add-post.php"><span class="glyphicon glyphicon-pencil"></span>Create Post</a></div>';
                                }
                            ?>
                            
                            <div class="hover"><a href="list-post.php"><span class="glyphicon glyphicon-list-alt"></span>View Post</a></div>
                        </div>
                    </div>
                    <div class="hover">
                        <a href="inbox.php"><span class="glyphicon glyphicon-comment"></span>Inbox</a>
                    </div>
<?php
if (Session::get('user_role') === 'Admin') {
    $sql = "SELECT COUNT(status) as s FROM user_info WHERE status = 'pending' AND user_role IS NULL";
    $result = DB::getInstance()->select($sql);
    if ($result) {
        while ($row = $result->fetch_object()) {
?>
            <div class="hover">
                <a href="list-user.php"><span class="glyphicon glyphicon-user"></span>User(<?php echo $row->s; ?>)</a>
            </div>
<?php
        }
    }
}
?>
                </div>
            </div>
<!--sidebar-->
<!--content-->
            <div class="col-md-10 display-table-cell" id="content">