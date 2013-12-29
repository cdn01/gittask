
<?php
	// include("tweet.php");
	// $text='my first tweet !!!';
       
 //    $password='qingyu';
	// $username='cdn_02@126.com';

	// $bot=new Bot("https://mobile.twitter.com/session/new");
	// $html=$bot->request();
	
	// preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $html, $authenticity_token);
	// echo $authenticity_token=$authenticity_token[1];	
	
	// //登入
	// $bot->setUrl("https://mobile.twitter.com/session");
	// $bot->request("authenticity_token={$authenticity_token}&username=$username&password=$password");
	

	// $bot->setUrl("https://mobile.twitter.com/api/trends");
	// $html = $bot->request();
	// echo $html;



	// //发帖
	// $bot->setUrl("https://mobile.twitter.com/");	
	// $html=$bot->request("authenticity_token={$authenticity_token}&tweet[text]=text&commit=Tweet");
	// // print_r($html);

	// die("sdsdsdfsdf");
	// $bot->setUrl("https://mobile.twitter.com/session/destroy");
	// $rs = $html=$bot->request("authenticity_token={$authenticity_token}&commit=Sign out");
	
	// $bot->closeConnection();
 	
 	// $bot=new Bot("https://www.twitter.com");
 	// echo $html=$bot->request();

	include(str_replace("\\", "/", dirname(__FILE__))."/tweet.class.php"); 
	$tweet = new tweet();
	$tweet->login("cdn_01@126.com","qingyu");
	$tweet->create("test love ".date("Y-m-d H:i:s",time()));
?>