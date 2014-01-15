<?php
header("Content-type:text/html;charset=utf-8");

include("D:\wamp\www\curl\curl.class.php");

$curl = new myCurl();


function sendmessage($username,$psw,$message)
{
	global $curl;
	$url = "https://twitter.com/";
	$curl->openCurl($url);
	$_token = $curl->getOutput();
	preg_match("/token\" value=\"(.*)\">/iUs",$_token,$token_match);
	$token = $token_match[1];
	$postData = "session%5Busername_or_email%5D=".$username."&session%5Bpassword%5D=".$psw."&remember_me=1&return_to_ssl=true&scribe_log=&redirect_after_login=%2F&authenticity_token=".$token;
	$postUrl = "https://twitter.com/sessions";
	$curl->openCurl($postUrl,$postData);
	$curl->openCurl($url);

	$_token = $curl->getOutput();
	preg_match("/value=\"(.*)\" name=\"authenticity_token/iUs",$_token,$token_match);
	$token = $token_match[1];


	$postData = "place_id=&status=".time().time().time().urlencode($message).date("Y-m-d H:i:s",time())."&authenticity_token=".$token;
	$postUrl = "https://twitter.com/i/tweet/create";
	//$curl->openCurl($postUrl,$postData);
	//$create = $curl->getOutput();
	//return json_decode($create);
}
sendmessage("backcn","qingyu","测试定时发布功能！");
print_r($curl->getOutput());
$sql = "update test set id = id+1 ";
mysql_query($sql);
$curl->closeCurl();
//$id = $_REQUEST['id']+1;

?>
<script type='text/javascript'> 
window.onload  = function(){
	//setTimeout("location.href='index.php?id=<?php echo $id;?>'",1000);
}
</script>
