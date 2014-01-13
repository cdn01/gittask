<?php
	include("/var/www/html/twitter/lib/curl.class.php");
     	include("/var/www/html/twitter/lib/config.php");
	date_default_timezone_set("Asia/Chongqing");
	/*
	include("/var/www/html/twitter/lib/Snoopy.class.php");
	$snoopy = new Snoopy();
	$url = "http://www.google.com/trends/hottrends/hotItems";
	$post_data = array("ajax"=>"1","htd"=>"20131118","pn"=>"p1","htv"=>1);
	$snoopy->submit($url,$post_data);
	print_r($snoopy->results);
	*/
	$j = 1;
	for($i=0;$i<2;$i++)
	{
		echo $htd = date("Ymd",strtotime("-".$i." day"));
		echo "\r\n";
		
		$url = "http://www.google.com/trends/hottrends/hotItems";
		$my_curl = new myCurl();
		$my_curl->openCurl($url,"ajax=1&htd=".$htd."&pn=p1&htv=l");
		//print_r($my_curl->getOutput());
		$response = json_decode($my_curl->getOutput(),true);
		//print_r($response['trendsByDateList']);
		$article = array();
		try{
			foreach($response['trendsByDateList'] as $_k=>$_v)
			{
				foreach($_v['trendsList'] as $__k=>$__v)
				{
					foreach($__v['newsArticlesList'] as $____v)
					{
						$article[]= $____v;
						// echo $sql = "insert into article (title,link,source,snippet,gettime) values ('".$____v['title']."','".$____v['link']."','".$____v['source']."','".$____v['snippet']."','".time()."')";		
						$sql = " call insertarticle('".$____v['title']."','".$____v['link']."','".$____v['source']."','".$____v['snippet']."','".time()."')";
						//echo "\r\n";
						mysql_query($sql);
						file_put_contents("/var/www/html/twitter/log/log_".date("Ymd",time()),$____v['title']."->".$____v['link']."\r\n",FILE_APPEND);
					}
				}
			}
		}catch(Exception $e){
			sleep(20);
			file_put_contents("/var/www/html/twitter/log/log_".date("Ymd",time()),$e->getMessage()."\r\n===================================================\r\n",FILE_APPEND);
		}
		$my_curl->closeCurl();
		file_put_contents("/var/www/html/twitter/log/log_".date("Ymd",time()),"\r\n===========================".$htd."========================\r\n",FILE_APPEND);
		//print_r($article);		
	}








































?>
