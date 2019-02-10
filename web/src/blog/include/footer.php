    <div id="footer" class="overflow">
        <p>&copy; <a href="index.php">www.example.com</a></p>
    </div>
    <div class="fixedicon overflow">
<?php
//social media icon
$sql = "SELECT * FROM social_media WHERE used=1";
$result = DB::getInstance()->select($sql);

if ($result) {
	while ($row = $result->fetch_object()) {
		echo '<a href="'.$row->url.'"><img src="http://localhost/blog/'.$row->icon.'" alt="'.$row->name.'"/></a>';
	}
}

?>
	</div>
</body>
</html>