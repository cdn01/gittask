<?php
include(str_replace("\\", "/", dirname(__FILE__))."/wb/conn.php");   


$sql = "select * from article where ispost = 0 order by gettime desc limit 1 ";
$article_rs = query($user_sql);
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


$param['uname'] = 'cmd_03@126.com';
$param['pwd'] = 'qingyu';
$wb = new weibo();
// 登录
$islogin = $wb->login($param);

?>