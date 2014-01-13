<?php
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("twitter");
	mysql_query("set names utf8");
	set_time_limit(0);
	date_default_timezone_set('Asia/Chongqing');
?>
