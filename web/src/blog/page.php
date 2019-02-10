<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/header.php';
?>
<!-- #end navigation -->
    <div id="page" class="overflow">
        <div id="content" class="overflow">
            <div class="post overflow">
<?php

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    $sql = "SELECT * FROM pages WHERE page_id=$p_id";
    $result = DB::getInstance()->select($sql);

    if ($result) {
        $row = $result->fetch_object();
        echo '<h1>' . $row->page_name . '</h1>';
        echo '<p>' . $row->page_content . '</p>';
    }
    else {
        echo 'Page not Found';
    }
}
else {
    echo 'Page not Found';
}


?>
            </div>
        </div>
<!-- #end content -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/sidebar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/footer.php';
?>