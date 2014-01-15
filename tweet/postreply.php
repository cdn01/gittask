<?php
	include(str_replace("\\", "/", dirname(__FILE__))."/conn.php"); 
	include(str_replace("\\", "/", dirname(__FILE__))."/TweetBot.php"); 


    $password='qingyu';
	$username='cdn_01@126.com';  
	$msg = "happy new year sss ".date("Y-m-d H:i:s",time());
	$bot=new TweetBot();  
	echo $authenticity_token=$bot->getToken();  
	$html=$bot->login($username,$password);  

	$sql = "select * from en_article where ispost=0 order by replynum asc limit 1 ;";
	$en_article = query($sql); 

	$sql = "update en_article set ispost = 1 where articleid = '".$en_article[0]['articleid']."'";
	mysql_query($sql);

	////////// 
	$sql = "select * from twitter_reply where isreply = 0 order by gettime desc limit 1;";
	$reply = query($sql);
	$sql = "update twitter_reply set isreply = 1 where id = '".$reply[0]['id']."'";
	mysql_query($sql);

	////// 
	 


	////
	echo "\n";
	echo "\n";
	echo $reply_url = short_url("http://mall0592.duapp.com/index.php?_t=".date("Y/d/m/H/i/s",time())."&c=f");
	echo "\n";
	echo "\n";
	echo $msg = "@".$reply[0]['user']."  ".html_decode($en_article[0]['title'])."  ".$reply_url;
	echo "\n";

	echo $refer = "https://mobile.twitter.com/".$reply[0]['user']."/status/".$reply[0]['pid']; 

	$html = $bot->html($refer);

	echo $html = $bot->status_activity($reply[0]['pid']);
	
	echo "\n";
	// echo $html = $bot->create($msg,$reply[0]['pid']);
	echo $html = $bot->reply($reply[0]['pid'],$msg,$refer);
	//print_r($html);
?>
<script type='text/javascript'>
	 
</script>