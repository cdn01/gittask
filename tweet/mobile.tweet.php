<?php
	class mobileTweet{
		public $ch,$cookie,$token;
		public function __construct(){
			$this->ch = curl_init();
		}
		public function html($url,$post=false){
			curl_setopt($this->ch, CURLOPT_URL, $url);
			if($post){
				curl_setopt($this->ch,CURLOPT_POSTFIELDS, $post);
				curl_setopt($this->ch, CURLOPT_POST, 1);
			}
			else{
				curl_setopt($this->ch, CURLOPT_POST, 0);
			}
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie);
			curl_setopt($this->ch, CURLOPT_HEADER, 0);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0");
			$html = curl_exec($this->ch); 
			return $html;
		}
		public function getToken($url){
			$html = $this->html($url);
			preg_match("/name=\"authenticity_token\" type=\"hidden\" value=\"(.*)\"/iUs", $html,$token_m);
			return $this->token = $token_m[1];
		}

		public function login($user,$psw){
			$post_url = "https://mobile.twitter.com/session";
			$post_data = "authenticity_token={".$this->token."}&username=".$user."&password=".$psw;
			$html = $this->html($post_url,$post_data);
		}

		public function create($msg){ 
			$post_url = "https://mobile.twitter.com/";
			$post_data = "authenticity_token={".$this->token."}&tweet[text]=".$msg."&commit=Tweet";
			$html = $this->html($post_url,$post_data);
		}
	}
?>

<?php

	$mobile = new mobileTweet();

	/*
		getToken
	*/
	$login_page = "https://mobile.twitter.com/session/new";
	$token = $mobile->getToken($login_page);
	echo $token."<br>";
	/*
		login
	*/
	$user = "cdn_01@126.com";
	$psw = "qingyu";
	$login_content = $mobile->login($user,$psw);
	echo $login_content;

	/*
		create
	*/

	$create_content = $mobile->create("happy new year ".time());
	echo $create_content;








?>