<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/header.php';
?>
<div id="page" class="overflow">
    <div id="content" class="overflow">
<?php
    if (isset($_GET['search_query'])) {
        $search_query = sanitize($_GET['search_query']);

        $sql = "SELECT * FROM post WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%' ORDER BY publish_date DESC";
        $result = DB::getInstance()->select($sql);

        if ($result) {
            echo '<p>' . $result->num_rows . ' results found.</p>';
            while ($row = $result->fetch_object()) {
?>
<div class="post overflow">
    <h2><a href="post.php?id=<?php echo $row->id; ?>"><?php echo $row->title; ?></a></h2>
    <p class="meta">
        Posted by <a href="http://localhost/blog/author.php?id=<?php echo $row->author; ?>"><?php echo $row->author; ?></a> on <?php echo formatDate($row->publish_date);?>&nbsp;&bull;&nbsp;<a href="post.php?id=<?php echo $row->id; ?>" class="permalink">Full article</a>
    </p>
    <a href="post.php?id=<?php $row->id; ?>"><img src="http://localhost/blog/<?php echo $row->image; ?>" alt="post image"></a>   
    <p>
        <?php echo formatText($row->content); ?>
    </p>
</div>
<?php
        }
    }
    else {
        echo 'no result found.';
    }
}
else {
?>
<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];    
}
else{
    $page = 1;
}
$num_post=3;
$start_page = ($page-1)*$num_post;
$sql = "SELECT * FROM post";
$result = DB::getInstance()->select($sql);
$total_row = $result->num_rows;
$total_page = ceil($total_row/$num_post);
?>
<!-- #end navigation -->
<?php
$sql = "SELECT * FROM post ORDER BY publish_date DESC LIMIT $start_page,$num_post ;";
$result = DB::getInstance()->select($sql);
if($result){
	while($post = $result->fetch_object()){
?>          
			<div class="post overflow">
                <h2><a href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h2>
                <p class="meta">
                    Posted by <a href="http://localhost/blog/author.php?id=<?php echo $post->author; ?>"><?php echo $post->author; ?></a> on <?php echo formatDate($post->publish_date);?>&nbsp;&bull;&nbsp;<a href="post.php?id=<?php echo $post->id; ?>" class="permalink">Full article</a>
                </p>
                <a href="post.php?id=<?php echo $post->id; ?>"><img src="http://localhost/blog/<?php echo $post->image; ?>" alt="post image"></a>   
                <p>
				<?php echo formatText($post->content);?>
                </p>
            </div>
<?php
	}
}
?>
<!-- pagination-->
<?php
    for($i=1; $i<=$total_page; $i++){
        echo "<span class='pagination'><a href='index.php?page=$i'>$i</a></span>";
    }
}
?>
<!--pagination-->			
        </div>
<!-- #end content -->

 
<?php
include("include/sidebar.php");
include("include/footer.php");
?>