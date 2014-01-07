<?php
include(str_replace("\\", "/", dirname(__FILE__))."/wb/conn.php");  
include(str_replace("\\", "/", dirname(__FILE__))."/wb/wb.php");  
 
$param['uname'] = 'cmd_01@126.com';
$param['pwd'] = 'qingyu';
$wb = new weibo();
// 登录
$islogin = $wb->login($param);
// 获取用户信息  
//$result = $wb->sendWeibo($message." \n  详情:".$url,$img_rs[0]['dir']); 
$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];
$page_url = "http://m.weibo.cn/index/getHomeData?uicode=20000060&page=".$page;
$content = substr($wb->_html($page_url),(strpos($wb->_html($page_url), '{"advertises":')));
$list_arr = json_decode($content,true); 
echo $page;
// print_r($list_arr['mblogList']);
foreach ($list_arr['mblogList'] as $key => $value) {
	$mid = $value['mid'];
	$gettime = date("Y-m-d H:i:s",time());
	$guser = $value["user"]["screen_name"];
	$gtext = $value["text"];
	$sql = "insert into reply (mid ,gettime,guser,gtext) values ('".$mid."','".$gettime."','".$guser."','".$gtext."')";
	mysql_query($sql);
} 
 
?>
<script type='text/javascript'>
	setTimeout("location.href='test.php?page=<?php echo $page+1;?>'",5000);
</script>