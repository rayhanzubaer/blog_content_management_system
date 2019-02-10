<?php
$sql = "SELECT * FROM category;";
$result = DB::getInstance()->select($sql);
?>
       <div id="sidebar" class="overflow">
            <h2>Categories</h2>
            <ul>
<?php
while ($value = $result->fetch_object()) {
?>
                <li><a href="category.php?category=<?php echo $value->categoryID; ?>"><?php echo $value->name; ?></a></li>
<?php	
}
?>
			</ul>
				<h2>Archive</h2>
					<ul>
					
<?php

$sql = "SELECT DISTINCT year FROM post ORDER BY year DESC;";
$result = DB::getInstance()->select($sql);

if ($result) {
	$i = 0;
	while ($value = $result->fetch_object()) {
		echo '<li><a href="javascript:void(0)"  onclick="accordion('.$i.')">' . $value->year . '</a"></li><ul class="collapse">';
		$sql = "SELECT DISTINCT month_year FROM post WHERE year='$value->year' ORDER BY month_year DESC";
		$monthYear = DB::getInstance()->select($sql);

		if ($monthYear) {
			while ($month = $monthYear->fetch_object()) {
				echo '<li><a href="archive.php?a=' . $month->month_year . '">' . formatMonth($month->month_year) . '</a></li>';
			}	
		}
		echo '</ul>';
		$i++;
	}
}

?>
						</ul>
		</div>
    </div>