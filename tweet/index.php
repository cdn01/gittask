<?php
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
  
$url = "https://twitter.com/";
$cookie = "";
ob_start();
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, true);  
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host:twitter.com",
										   "Referer:https://twitter.com/",
										   "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0",
										   "Accept-Encoding:gzip, deflate",
										   "Connection:keep-alive"));
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
/*
if ( $post){
		curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
}
*/
if ( strpos($url, 'https') !== false) {
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
}
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
$indexHtml = curl_exec($ch);
file_put_contents("t.html",$indexHtml);
curl_close($ch);
$_str = ob_get_contents();  

ob_end_clean();

 
//merry_viupoy@sogou.com
//$sendText = array(htmlspecialchars_decode($article_rs[0]['title']),htmlspecialchars_decode($article_rs[0]['content']));
//$response = sendmessage("cnd_02@126.com","qingyu","hello world , i am a tweet robot");
//print_r($response);
 
  

?>
 
