<?php
	include(str_replace("\\", "/", dirname(__FILE__))."/conn.php"); 
	include(str_replace("\\", "/", dirname(__FILE__))."/TweetBot.php"); 
    $password='qingyu';
	$username='cdn_01@126.com';  
	$msg = "happy new year sss ".date("Y-m-d H:i:s",time());
	$bot=new TweetBot(); 
	// echo "<hr>getToken<br>";
	// echo $authenticity_token=$bot->getToken();  
	// echo "<hr>login<br>";
	$html=$bot->login($username,$password); 
	echo "<hr>create<br>";
	// $html=$bot->create($msg); 
	// echo "<hr>homeHtml<br>";

	
	// echo $html = $bot->html("https://mobile.twitter.com/i/discover");
	//print_r($bot->getHeader()) ;
	// $html = $bot->discover();

	// $content_arr = json_encode($html);

	// print_r($content_arr);

	// echo "<hr>getCookie<br>";
	// echo $bot->getCookie();

	echo "<hr>discover<br>";
	// print_r() ;
	// $cursor = $_GET["next"]?$_GET["next"]:"";
	// $modles = $bot->discover($cursor);
	// //print_r($modles["modules"] );
	// foreach($modles["modules"] as $k=>$v){
	// 	$id = $v["status"]["data"]["id"];
	// 	$username = $v["status"]["data"]["user"]["screen_name"];
	// 	if($username!="" and $username !=null){
	// 		$sql = "insert into reply (user,pid,gettime) values ('".$username."','".$id."','".date("Y-m-d H:i:s",time())."')";
	// 		mysql_query($sql);	
	// 	}
	// }
	// print_r($modles["metadata"]);
	// $next_cursor = $modles["metadata"]["next_cursor"];
	// $bot->discover($next_cursor);

	echo $cursor = $_GET["next"]?$_GET["next"]:"";
	$html = $bot->getSearch("b",$cursor); 
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