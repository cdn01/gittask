<?php
	$conn = mysql_connect("192.168.26.141","root","123456");
	mysql_select_db("task");
	mysql_query("set names utf8");
	set_time_limit(0);
	date_default_timezone_set('Asia/Chongqing');
	
	function str_conv($str)
	{
		// $str = str_replace("\n", "<br>", $str);
		$str = addslashes ($str);
		return $str;
	}

?>
