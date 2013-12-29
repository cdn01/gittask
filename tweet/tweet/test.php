<?php

# First call gets hidden form field authenticity_token
# and session cookie

$ch = curl_init();
$sTarget = "https://twitter.com/";
$cookie = "";
curl_setopt($ch, CURLOPT_URL, $sTarget);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0");
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_REFERER, "https://twitter.com/");
$html = curl_exec($ch);

# parse authenticity_token out of html response
preg_match('/<input type="hidden" value="([a-zA-Z0-9]*)" name="authenticity_token"\/>/', $html, $match);
$authenticity_token = $match[1];

$username = "cdn_01@126.com";
$password = "qingyu";

/*

	login
	
*/
# set post data
$sPost = "session[username_or_email]=$username&session[password]=$password&return_to_ssl=true&scribe_log=&redirect_after_login=%2F&authenticity_token=$authenticity_token";

# second call is a post and performs login
$sTarget = "https://twitter.com/sessions";
curl_setopt($ch, CURLOPT_URL, $sTarget);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $sPost);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));

# display server response
$html = curl_exec($ch); 

/*
	create
*/

$cPost = "authenticity_token=".$authenticity_token."&place_id=&status=".time();

$sTarget = "https://twitter.com/i/tweet/create";
curl_setopt($ch, CURLOPT_URL, $sTarget);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $cPost);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded")); 
$html = curl_exec($ch); 


/*



*/

  
curl_close($ch);
// print_r($ch_s);
?>