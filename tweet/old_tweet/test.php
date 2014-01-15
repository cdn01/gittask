
<?php 
	$page_start = microtime();
	date_default_timezone_set("Asia/Chongqing");
	header("Content-type:text/html;charset=utf-8");
	include(str_replace("\\", "/", dirname(__FILE__))."/tweet.class.php");
	$tweet = new tweet();
	$tweet->login("cdn_01@126.com","qingyu");
	$tweet->create("test love ".date('Y-m-d H:i:s',time()));
	$discover = $tweet->getDiscoverList();
	$discover_arr = json_decode($discover,true);
	file_put_contents("abc", serialize($tweet));
	// print_r($discover_arr);
	preg_match_all("/<span class=\"username js-action-profile-name\"><s>@<\/s><b>(.*)<\/b>/iUs", $discover_arr["page"], $names);
	print_r($names);





	$page_end = microtime();
	$starttime = explode(" ",$page_start);
	$endtime = explode(" ",$page_end);
	$totaltime = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost = sprintf("%s",$totaltime);
	echo "页面运行时间: $timecost 秒";
?>