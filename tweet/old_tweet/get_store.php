<?php
//http://shopping.yahoo.com/stores/letter--a/results--45
/*
 * 
 create table stores(
  id int primary key auto_increment,
  name varchar(250),
  tag varchar(250),
  keywords varchar(250)
  )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 * */
set_time_limit(0);
$conn = mysql_connect("localhost","root","");
	mysql_select_db("amazon",$conn);
	mysql_query("set names utf8");
include 'Snoopy.class.php'; 
$snoopy = new Snoopy();
 

$tag_arr = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9");
//print_r($tag_arr);
foreach($tag_arr as $key=>$val)
{
	$index = 1;
	do{
		echo "<hr>";
		echo $url = "http://shopping.yahoo.com/stores/letter--".strtolower($val)."/results--45/page--".$index;
		echo "<br>";
		$snoopy->fetch($url);
		$page = $snoopy->results;
		preg_match_all("/<h2 class=\"title\"><a(.*)>(.*)<\/a><\/h2>/iUs", $page, $list_match);
		foreach ($list_match[2] as $lkey => $lval)
		{
			$sql = "insert into stores (name,tag) values ('".htmlspecialchars($lval,ENT_QUOTES)."','".$val."')";
			mysql_query($sql);
		}
		$index++;
	}while(count($list_match[2]));
	
//	die();
}