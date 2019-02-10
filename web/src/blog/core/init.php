<?php

session_start();
error_reporting(0);

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'blog');

spl_autoload_register(function ($class_name) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/library/' . $class_name . '.php';
});

require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/function/function.php';

?>