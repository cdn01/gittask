
<?php 
	date_default_timezone_set("Asia/Chongqing");
	include(str_replace("\\", "/", dirname(__FILE__))."/tweet.class.php");
	$tweet = new tweet();
	$tweet->login("cdn_01@126.com","qingyu");
	$tweet->create("test love ".date('Y-m-d H:i:s',time()));
	$discover = $tweet->getDiscoverList();
	echo $discover;

?>