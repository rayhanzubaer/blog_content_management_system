<?php

function sanitize($data) {
	return htmlentities(stripslashes(trim($data)));
}

function formatDate($date){
	return date('F j,Y g:i:s a', strtotime($date));
}

function formatMonth($date){
	return date('F', strtotime($date . '-01 00:00:00'));
}

function formatText($text){
	$text = substr($text,0,300);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text.'...';

	return $text;
}

function redirectTo($location) {
	header('Location:' . $location);
	exit();
}

function socialMediaStatus($status) {
	if ($status == 1) {
		return 'using';
	}
	else {
		return 'not using';
	}
}
?>