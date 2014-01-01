<?php
/*
http://www.clshack.com :D 
*/
class TweetBot
{
	private $url;
	private $conn;
	private $user_agent;
	private $debug=false;
	private $cookie="cookies.txt_file";
	private $token;
	
	/*__construct*/
	public function __construct($url_input=""){
		$this->conn=curl_init();
		$this->setUrl($url_input);
		$this->setUserAgent($this->getUserAgent());
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
	public function request($post=false){
		echo $this->getUrl();
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
	public function getToken(){ 
		$this->setUrl("https://mobile.twitter.com/session/new");
		$html=$this->request();
		preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $html, $authenticity_token);
		return $this->token = $authenticity_token[1];	
	}
	public function create($msg){
		$this->setUrl("https://mobile.twitter.com/");	
		$authenticity_token = $this->token;
		return $html=$this->request("authenticity_token={$authenticity_token}&tweet[text]=$msg&commit=Tweet");
	}
	public function login($user,$psw){
		$this->setUrl("https://mobile.twitter.com/session");
		$authenticity_token = $this->token;
		return $html=$this->request("authenticity_token={$authenticity_token}&username=$user&password=$psw");
	}
	public function html($url){
		$this->setUrl($url);
		return $html=$this->request();
	}
	/*END-GET-SETTERS VARIABLE*/
}
?>

<?php

	$text='http://www.clshack.com';
    $password='qingyu';
	$username='cdn_01@126.com'; 

	$msg = "happy new year sss ".date("Y-m-d H:i:s",time());
	$bot=new TweetBot(); 
	echo "<hr>getToken<br>";
	$authenticity_token=$bot->getToken();  
	echo "<hr>login<br>";
	$html=$bot->login($username,$password); 
	// echo "<hr>create<br>";
	// $html=$bot->create($msg); 
	echo "<hr>homeHtml<br>";

	$html = $bot->html("https://mobile.twitter.com/api/universal_discover");

	$content_arr = json_encode($html);

	print_r($content_arr);







?>