<?php
	date_default_timezone_set("Asia/Chongqing");
	header("Content-type:text/html;charset=utf-8");
	include(str_replace("\\", "/", dirname(__FILE__))."/tweet.class.php");
	$tweet = new tweet();
	$tweet = unserialize(file_get_contents("abc"));
	$tweet->create("test love 22 ".date('Y-m-d H:i:s',time()));
?>