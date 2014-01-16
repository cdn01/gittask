<?php
	include(str_replace("\\", "/", dirname(__FILE__))."/conn.php"); 
	include(str_replace("\\", "/", dirname(__FILE__))."/TweetBot.php"); 
    $password='qingyu';
	$username='cdn_01@126.com';  
	$msg = "happy new year sss ".date("Y-m-d H:i:s",time());
	$bot=new TweetBot();   
	$html=$bot->login($username,$password);  

	echo "<hr>discover<br>"; 
	echo $cursor = $_GET["next"]?$_GET["next"]:"";
	$html = $bot->getSearch("c",$cursor); 
	print_r($html);
	foreach($html["modules"] as $k=>$v){
		$id = $v["status"]["data"]["id"];
		$username = $v["status"]["data"]["user"]["screen_name"];
		$nick = $v["status"]["data"]["user"]["name"];
		if($username!="" and $username !=null){
			$sql = "insert into twitter_reply (user,pid,gettime,nick) values ('".$username."','".$id."','".date("Y-m-d H:i:s",time())."','".$nick."')";
			mysql_query($sql);	
		}
	}

?>
<script type='text/javascript'>
	setTimeout("location.href='getreply.php?next=<?php echo $html['metadata']['cursor'];?>'",10000);
</script>