<?php 
	include("/var/www/html/twitter/lib/curl.class.php");
	$my_curl = new myCurl();
	$my_curl->openCurl("http://goo.gl/");
	echo $response = $my_curl->getOutput();
	preg_match("/id=\"security_token\" type=\"hidden\" value=\"(.*)\"/iUs",$response,$code);
	print_r($code);





	$my_curl->closeCurl();


?>
