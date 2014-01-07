<?php

	define("DB_ROOT", "localhost");
	define("DB_USER", "root");
	define("DB_PWD", "");
	define("DB_DATA", "tweet"); 
	define("DB_CHAR", "utf8");
	define("WWW", "/var/www/html/task/trunk/");
	mysql_connect(DB_ROOT,DB_USER,DB_PWD);
	mysql_select_db(DB_DATA);
	mysql_query("set names ".DB_CHAR);
	header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set("Asia/Chongqing");
	set_time_limit(0);
	// require_once(WWW."wb.php");
	// require_once(WWW."curl.class.php");
	// require_once(WWW."common.php");


	
	// mylog("sdf");s
?>