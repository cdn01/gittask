<?php
include '/var/www/html/twitter/lib/EpiCurl.php';
include '/var/www/html/twitter/lib/EpiOAuth.php';
include '/var/www/html/twitter/lib/EpiTwitter.php';
include '/var/www/html/twitter/lib/config.php';
/*
$consumer_key = 'OuqIsmP7zNeHbnUiyGjg';
$consumer_secret = 'P48il3NcEDR8zRdj0htJr7otj8FRa5drtvdEdZsGMc';
$token = '1961761363-kFuhWEIpC6wZWnGjbhHzAmsxi4ISKfsiugZ3D6E';
$secret= 'dtFxgqOFf3qpdHbXCDnEXlpUh58GKU8Mzxi1Gqm5t8';
*/

$consumer_key = 'vDcatr3fI4wL8VEraeg';
$consumer_secret = 'QBmGtBjTRp9NGEEXnclWqgy4MBGGmFDJbNdyNC5EEE';
$token = '1896570343-1Dc11bHJMJXhWVQwEVIAk58HvZSrop1k2MOSDXZ';
$secret= 'a1KYWV1hiQeOK2Jp1qhtyUomnnfHKc7IQa7cfPpEI';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $token, $secret);
$count = mysql_fetch_array(mysql_query("select count(*) as total  from article where istweet = 1"));
if($count['total']>990) mysql_query("update article set istweet=0 ");
$cmd = @mysql_query("select * from article where istweet = 0 order by articleid desc limit 1");
$rs = @mysql_fetch_array($cmd);
if($rs['articleid'])
{
	$rs["title"] = str_replace("&#39;","'",htmlspecialchars_decode(preg_replace("/<\/?(.*)>/iUs"," ",$rs['title'])));
	$params = array('status'   => $rs['title']."  http://goo.gl/8pt1de?".time() ); 
	$status = $twitterObj->post('/statuses/update.json', $params);
	$sql = "update article set istweet = 1 where articleid ='".$rs['articleid']."'";
	mysql_query($sql);
	file_put_contents("/autonovel/log",$rs['title']."========Tweet Test2=========".date("Y-m-d H:i:s",time())."\r\n",FILE_APPEND);
}
//$params = array('status'   => 'my status'.date("Y-m-d H:i:s",time()));
//$status = $twitterObj->post('/statuses/update.json', $params);

?>
  
<?php print_r($status); ?>

