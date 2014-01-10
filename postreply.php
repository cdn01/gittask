<?php
include(str_replace("\\", "/", dirname(__FILE__))."/wb/conn.php");   


$sql = "select * from article where ispost = 0 order by gettime desc limit 1 ";
$article_rs = query($sql);
if($article_rs){
	$sql = "update article set ispost = 1 where id = $article_rs[0]['id']";
	mysql_query($sql);	
}

$sql = "select * from reply where ispost = 0 order by gettime desc limit 1 ";
$reply_rs = query($sql);
if($reply_rs){
	$sql = "update reply set ispost = 1 where id = $reply_rs[0]['id']";
	mysql_query($sql);
}


$sql = "select * from account order by postnum asc limit 1";
$account_rs = query($sql);
if($account_rs){
	$sql = "update article set postnum = postnum + 1 where id = $account_rs[0]['id']";
	mysql_query($sql);	
}
$wb = new weibo();
// 登录
$islogin = $wb->login(array('uname' => $account_rs[0]["user"], 'pwd' => $account_rs[0]["psw"] )); 
echo $url = "http://mall0592.duapp.com/?_=".time()."&id=".$account_rs[0]["id"]."&uname=".urlencode($account_rs[0]["user"]);
echo $url = shortUrl($url);


















?>