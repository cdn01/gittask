<?php
//http://shopping.yahoo.com/brands/
//http://shopping.yahoo.com/stores
/*
 * 
  create table brands(
  id int primary key auto_increment,
  name varchar(250),
  tag varchar(250),
  keywords varchar(250)
  )ENGINE=MyISAM DEFAULT CHARSET=utf8;


 * 
 * 
 * */
$conn = mysql_connect("localhost","root","");
	mysql_select_db("amazon",$conn);
	mysql_query("set names utf8");
include 'Snoopy.class.php';
$url = "http://shopping.yahoo.com/brands/";
$snoopy = new Snoopy();
$snoopy->fetch($url);
$page = $snoopy->results;
//echo $page;
preg_match("/<div class=\"brands-listing\">(.*)<div class=\"spacer-10\"><\/div><\/div>/is", $page,$page_match);
preg_match_all("/<div>(.*)<br \/>/iUs", $page_match[1], $list_match);
$tag = '';
foreach ($list_match[1] as $key => $val)
{
	$index = $key+1;
	if($index%2===0)
	{ 
		preg_match_all("/<a(.*)>(.*)<\/a>/iUs", $val, $brands_match);
		foreach ($brands_match[2] as $bkey=>$bval)
		{
			$sql = "insert into brands (name,tag) values ('".$bval."','".$tag."')";
			mysql_query($sql);
		}
	}else{
		preg_match("/<strong>(.*)<\/strong>/iUs", $val ,$tag_match);
		$tag = $tag_match[1];
	}
}