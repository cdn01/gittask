<?php
include(str_replace("\\", "/", dirname(__FILE__))."/wb/conn.php");  
include(str_replace("\\", "/", dirname(__FILE__))."/wb/wb.php");  
 
$param['uname'] = 'cmd_02@126.com';
$param['pwd'] = 'qingyu';
$wb = new weibo();
// 登录
$islogin = $wb->login($param);
// 获取用户信息  
//$result = $wb->sendWeibo($message." \n  详情:".$url,$img_rs[0]['dir']); 
$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];
$page_url = "http://m.weibo.cn/news/mblog?&page=".$page;
// $page_url = "http://m.weibo.cn/index/getHomeData?uicode=20000060&page=".$page;
$content = substr($wb->_html($page_url),(strpos($wb->_html($page_url), '{"mblogList":')));

$list_arr = json_decode($content,true); 
// print_r($list_arr);
// die();
echo $page;
// print_r($list_arr['mblogList']);
foreach ($list_arr['mblogList'] as $key => $value) {
	$mid = $value['mid'];
	$gettime = date("Y-m-d H:i:s",time());
	$guser = $value["user"]["screen_name"];
	$gtext = $value["text"];
	echo $sql = "insert into reply (mid ,gettime,guser,gtext) values ('".$mid."','".$gettime."','".$guser."','".$gtext."')";
	echo "<hr><br>";
	mysql_query($sql);
} 
 
?>
<script type='text/javascript'> 
	var len = <?php echo count($list_arr)?>;
	var nextpage=<?php echo $page+1;?>;
	if(nextpage > 10){
		setTimeout("location.href='getreply2.php?page=1'",20000);
	}
	else if(len==undefined||len<1){
		setTimeout("location.href='getreply2.php?page=<?php echo $page;?>'",10000);
	}
	else
	setTimeout("location.href='getreply2.php?page=<?php echo $page+1;?>'",10000);
</script>