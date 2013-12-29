<?php
	function getToken(&$ch,&$cookie){
		$login_url = "https://mobile.twitter.com/session/new";
		curl_setopt($ch, CURLOPT_URL, $login_url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0");
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt($ch, CURLOPT_REFERER, "https://twitter.com/");
		$html = curl_exec($ch);
		preg_match("/token\" type=\"hidden\" value=\"(.*)\"/", $html , $match);
		$token = $match[1];
		return $token;
	}

	function login(&$ch,$token,$user,$pws){
		$post_url = "https://mobile.twitter.com/session";
		echo $post_data = "authenticity_token=".$token."&username=".urlencode($user)."&password=".$pws;

		curl_setopt($ch, CURLOPT_URL, $post_url); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));

		$html = curl_exec($ch); 
		return $html;

	}
	$ch = curl_init();
	$cookie = "";
	$token = getToken($ch,$cookie);
	echo $token;
	$user = "cdn_01@126.com";
	$pws = "qingyu";
	$login = login($ch,$token,$user,$pws);
	echo $login;
?>