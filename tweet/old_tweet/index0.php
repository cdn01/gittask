<?php
set_time_limit(0);
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
class Bot
{
	private $url;
	private $conn;
	private $user_agent;
	private $debug=false;
	private $cookie="D:/wamp/www/tweet/cookies.txt";
	
	/*__construct*/
	public function __construct($cookieFile){
		$this->conn=curl_init();
		$this->setUserAgent($this->getUserAgent());
		$this->cookie = $cookieFile;
	}
	/*END -__construct*/
	/*__destruct*/
	public function __destruct(){
		$this->conn=null;
		$this->url="";
		$this->user_agent="";
		$this->cookie="";
    }
	/*END __destruct*/
	
	/*function*/
	public function request($url_input,$post=false){
		$this->setUrl($url_input);
		if($this->conn!=null){
			curl_setopt($this->conn, CURLOPT_URL, $this->getUrl());
			if($post){
				curl_setopt($this->conn,CURLOPT_POSTFIELDS, $post);
				curl_setopt($this->conn, CURLOPT_POST, 1);
			}
			else{
				curl_setopt($this->conn, CURLOPT_POST, 0);
			}
			curl_setopt($this->conn, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->conn, CURLOPT_COOKIEJAR, $this->cookie);
			curl_setopt($this->conn, CURLOPT_COOKIEFILE, $this->cookie);
			curl_setopt($this->conn, CURLOPT_HEADER, 0);
			curl_setopt($this->conn, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->conn, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->conn, CURLOPT_USERAGENT, $this->user_agent);
			return curl_exec($this->conn);
		}
		return null;
	}
	public function closeConnection(){
		if($this->conn!=null){
			curl_close($this->conn);
		}
	}
	public function getUserAgent(){
		$agents = array(
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'
		);
		return $agents[array_rand($agents)];
	}
	/*END- function*/
	
	/*GET-SETTERS VARIABLE*/
	public function setUrl($url_input){
		$this->url=$url_input;
	}
	public function getUrl(){
		return $this->url;
	}
	public function setUserAgent($agent){
		$this->user_agent=$agent;
	}
	public function getUserAgentVar(){
		return $this->user_agent;
	}
	public function getCookie(){
		return file_get_contents($this->cookie);
	}
	/*END-GET-SETTERS VARIABLE*/
}
 
$password='qingyu';
$username='cdn_02@126.com';


$bot=new Bot("D:/wamp/www/tweet/cookies.txt");

$cookie = file_get_contents("D:/wamp/www/tweet/cookies.txt"); 
if(!strpos( $cookie,"1	guest_timeline_users")){  
	$html=$bot->request("https://mobile.twitter.com/session/new");
	preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $html, $authenticity_token);
	file_put_contents("D:/wamp/www/tweet/token.txt",$authenticity_token[1]);
}


echo $authenticity_token=file_get_contents("D:/wamp/www/tweet/token.txt");	 
$html=$bot->request("https://mobile.twitter.com/session","authenticity_token={$authenticity_token}&username=$username&password=$password");
 	
echo $html=$bot->request("https://mobile.twitter.com/","authenticity_token={$authenticity_token}&tweet[text]=text"."_".date("Y-m-d H:i:s",time())."&commit=Tweet");
print_r($bot->getCookie());
die();
$bot->setUrl("https://mobile.twitter.com/session/destroy");
$html=$bot->request("authenticity_token={$authenticity_token}&commit=Sign out");
$bot->closeConnection();



?>
 
