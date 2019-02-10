<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/core/init.php';
Session::remove();
redirectTo('login.php');
?>