<?php
	class tweet{
		public $user,$pws,$token,$ch,$cookie="";

		/*
			第一次访问返回Token
		*/
		function __construct($token=""){ 
			$this->ch = curl_init();
			if($token){
				$this->token = $token; 
			}else{
				$sTarget = "https://twitter.com/";
				curl_setopt($this->ch, CURLOPT_URL, $sTarget);
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0");
				curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie);
				curl_setopt($this->ch, CURLOPT_REFERER, "https://twitter.com/");
				$html = curl_exec($this->ch);
				preg_match('/<input type="hidden" value="([a-zA-Z0-9]*)" name="authenticity_token"\/>/', $html, $match);
				$this->token = $match[1]; 
				print_r($this->ch);
			} 
		}

		/*
			登入返回 cookie
		*/
		public function login($user,$pws){
			$sPost = "session[username_or_email]=".urlencode($user)."&session[password]=".$pws."&return_to_ssl=true&scribe_log=&redirect_after_login=%2F&authenticity_token=".$this->token;
			$login_url  = "https://twitter.com/sessions";
			curl_setopt($this->ch, CURLOPT_URL, $login_url);
			curl_setopt($this->ch, CURLOPT_POST, true);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $sPost);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
			$html = curl_exec($this->ch); 
		}

		/*
			提交tweet
		*/
		public function create($msg,$replyid="",$img = ""){
			$cPost = "";
			if($replyid){
				$cPost .= "in_reply_to_status_id=".$replyid."&";
			}
			if($img){

			}else{
				$cPost .= "authenticity_token=".$this->token."&place_id=&status=".$msg;
				$sTarget = "https://twitter.com/i/tweet/create";
				curl_setopt($this->ch, CURLOPT_URL, $sTarget);
				curl_setopt($this->ch, CURLOPT_POST, true);
				curl_setopt($this->ch, CURLOPT_POSTFIELDS, $cPost);
				curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded")); 
				$html = curl_exec($this->ch); 	
			}
		}
		/*
	
			发现 discover

		*/

		public function getDiscoverList($cursor){ 
			$get_url = "https://twitter.com/i/discover/timeline?include_available_features=1&include_entities=1&last_note_ts=0&scroll_cursor=".$cursor;
			curl_setopt($this->ch, CURLOPT_URL, $get_url);
			curl_setopt($this->ch, CURLOPT_POST, false); 
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded","X-Push-State-Request:true","X-Requested-With:XMLHttpRequest")); 
			$html = curl_exec($this->ch); 	
			return $html;
			
		}
	}
?>
 