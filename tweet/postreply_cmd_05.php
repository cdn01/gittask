<?php
	include(str_replace("\\", "/", dirname(__FILE__))."/conn.php"); 
	include(str_replace("\\", "/", dirname(__FILE__))."/TweetBot.php");  
    $password='qingyu';
	$username='cmd_05@126.com';   
	$bot = new TweetBot("cmd_05");    
	$html=$bot->login($username,$password);  

	$sql = "select * from en_article  order by replynum asc limit 1 ;";
	$en_article = query($sql);  
	$sql = "update en_article set ispost = 1 , replynum = replynum+1 where articleid = '".$en_article[0]['articleid']."'";
	mysql_query($sql); 
	$sql = "select * from twitter_reply where isreply = 0 order by gettime desc limit 1;";
	$reply = query($sql);
	$sql = "update twitter_reply set isreply = 1 where id = '".$reply[0]['id']."'";
	mysql_query($sql);  

	echo "\n";
	$reply_url = short_url("http://mall0592.duapp.com/index.php?_t=".date("Y/d/m/H/i/s",time())."&c=f"); 
	echo $msg = "@".$reply[0]['user']."  Daily News : ".html_decode($en_article[0]['title'])."  ".$reply_url;  
	$html = $bot->reply($reply[0]['pid'],$msg); 
?>
<script type='text/javascript'>
	 setTimeout("location.href='postreply_cmd_05.php'",1000*60*3);
</script>