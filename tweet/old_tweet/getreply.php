
<?php 
	set_time_limit(0);
	$page_start = microtime(); 
	include(str_replace("\\", "/", dirname(__FILE__))."/conn.php");
	include(str_replace("\\", "/", dirname(__FILE__))."/tweet.class.php");
	$tweet = new tweet();
	$tweet->login("cdn_01@126.com","qingyu");
	// $tweet->create("test love ".date('Y-m-d H:i:s',time()));
	if($_REQUEST["cursor"]){
		$cursor = $_REQUEST["cursor"];
	}else{
		$cursor = "FQL7AYwSTmV0d29ya1N0b3J5U291cmNlFQIYEk5ldHdvcmtTdG9yeVN";
	}
	
	$discover = $tweet->getDiscoverList($cursor);
	$discover_arr = json_decode($discover,true);
	// file_put_contents("abc", serialize($tweet));
	// print_r($discover_arr);

	/*
		name
	*/
	$html = $discover_arr["items_html"];
	preg_match_all("/<span class=\"username js-action-profile-name\"><s>@<\/s><b>(.*)<\/b>/iUs",$html , $names);
	print_r($names);

	/*
		pid
	*/
	

	preg_match_all("/id=\"stream-item-tweet-(.*)\"/iUs",$html,$pid_p);
	$pid_arr = $pid_p[1];

	print_r($pid_arr);
	
	foreach ($names[1] as $key => $value) {
		if($pid_arr[$key]){
			$sql = "insert into reply (user,pid,gettime) values ('".$value."','".$pid_arr[$key]."','".date("Y-m-d H:i:s",time())."')";
			mysql_query($sql);
		} 
	}

	


	$page_end = microtime();
	$starttime = explode(" ",$page_start);
	$endtime = explode(" ",$page_end);
	$totaltime = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
	$timecost = sprintf("%s",$totaltime);
	echo "页面运行时间: $timecost 秒";
?>

<script type="text/javascript">
	setTimeout("location.href='getreply.php?cursor=<?php echo $discover_arr['scroll_cursor'];?>'",10000);
</script>