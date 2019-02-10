<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/header.php';
?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$sql = "SELECT * FROM post WHERE id='$id'";
$result = DB::getInstance()->select($sql);
$value = $result->fetch_object();
?>
<!-- #end navigation -->
    <div id="page" class="overflow">
        <div id="content" class="overflow">
            <div class="post overflow">
                <h2><a href="post.php?id=<?php echo $value->id; ?>"><?php echo $value->title; ?></a></h2>
                <p class="meta">Posted by <a href="http://localhost/blog/author.php?id=<?php echo $value->author; ?>"><?php echo $value->author; ?></a>&nbsp;&bull;&nbsp;Last Modified by <a href="http://localhost/blog/author.php?id=<?php echo $value->last_modified_by; ?>"><?php echo $value->last_modified_by; ?></a>&nbsp;&bull;&nbsp;<?php echo formatDate($value->publish_date); ?></p>
                <img src="http://localhost/blog/<?php echo $value->image; ?>" alt="post image">   
                <p>
                    <?php echo $value->content; ?>
                </p>
            </div>
            <div class="related-post overflow">
                <h2>Related Posts</h2>
                <ul>
<?php
$category = $value->category;
$sql = "SELECT id,title FROM post WHERE category='$category' LIMIT 5;";
$result = DB::getInstance()->select($sql);
if($result){
    while($value=$result->fetch_assoc()){
?>
            
                    <li><a href="post.php?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></li>
                
<?php
    }
}
else{
    echo "No related article found.";
}
?>
                </ul>
            </div>
        </div>
<!-- #end content -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/sidebar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/footer.php';
?>