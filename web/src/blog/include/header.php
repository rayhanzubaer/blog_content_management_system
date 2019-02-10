<?php include $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php'; ?>

<?php

$sql = "SELECT * FROM title_description WHERE used=1";
$result = DB::getInstance()->select($sql);

if ($result) {
    $title_description = $result->fetch_object();    
}
$theme_select = DB::getInstance()->select("SELECT * FROM theme WHERE status=1");
$theme = $theme_select->fetch_object();
?>

<!DOCTYPE html>
<html>
<head>
    <title>blog website</title>
    <link rel="stylesheet" href="http://localhost/blog/css/<?php echo $theme->name; ?>.css">
    <link href="https://fonts.googleapis.com/css?family=Nova+Mono" rel="stylesheet">
    <script type="text/javascript" src="http://localhost/blog/js/script.js"></script>
</head>
<body>
    <div id="header" class="overflow">
        <a href="index.php">
            <img src="<?php echo 'http://localhost/blog/' . $title_description->logo; ?>" alt="logo">
            <h1><?php echo $title_description->title; ?></h1>
            <p><?php echo $title_description->description; ?></p>
        </a>
        <div id="search">
            <form action="index.php" method="GET">
                <input type="text" name="search_query" style="width:100px;" value="" placeholder="search" >
                <button>Go</button>
            </form>
            <a href="http://localhost/blog/admin/register.php">Become a Bloger.</a>
        </div>
    </div>
<!-- #end header -->
    <div id="navigation" class="overflow">
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
<?php

$sql = "SELECT * FROM pages";
$result = DB::getInstance()->select($sql);

if ($result) {
    while ($row = $result->fetch_object()) {
        echo '<li><a href="page.php?p_id=' . $row->page_id . '">' . $row->page_name . '</a></li>';
    }
}

?>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>