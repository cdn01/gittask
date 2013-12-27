<?php
set_time_limit(0);
include 'config.php';
include 'Snoopy.class.php';
$sql = "select * from article where isgetcontent = '0' and ispost = '0' limit 20";
$article_rs = mysqlQuery($sql);
$snoopy = new Snoopy();

foreach ($article_rs as $val)
{
	$url = "http://www.diffbot.com/api/article?token=c09654dc316af82d18a47e3972f0244e&url=".urlencode($val['link']);
	$snoopy->fetch($url);
	$response = json_decode($snoopy->results,TRUE);
	print_r($response);
	
	if(!empty($response["text"]))
	{
		$author = empty($response['author'])?"":$response['author'];
		echo $sql = "update article set title='".htmlspecialchars($response['title'],ENT_QUOTES)."',
					content='".htmlspecialchars($response['text'],ENT_QUOTES)."',
					author='".$author."',
					date='".$response['date']."',
					isgetcontent='1' where id = '".$val['id']."'";
				
		mysql_query($sql);
	}else{
		echo $sql = "update article set  isgetcontent='2' where id = '".$val['id']."'";
				
		mysql_query($sql);
	} 
	sleep(5);
	
}