<?php
header("Content-type:text/html;charset=utf-8");
include(str_replace("\\", "/", dirname(__FILE__))."/curl.class.php");  
//error_reporting(E_ALL);
$conn = mysql_connect("localhost","root","");
mysql_select_db("twitter",$conn);
mysql_query("set names utf8");
$curl = new myCurl();
/*
 create table user(
 id int primary key auto_increment,
 name varchar(250),
 psw varchar(250),
 type varchar(250)
 )DEFAULT CHARSET=utf8

 create table userName(
 id int primary key auto_increment,
 name varchar(250),
 type varchar(250)
 )ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=utf8;

 create table email(
 id int primary key auto_increment,
 mail varchar(250),
 psw varchar(250)
 )ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=utf8;
 * */

function mysqlQuery($sql)
{
	$arr = array();
	$cmd = mysql_query($sql);
	while($rs = mysql_fetch_assoc($cmd))
	{
		$arr[] = $rs;
	}
	return $arr;
}
function sendTextParse($textArr,$len=140)
{
	$re_str = "";
	foreach ($textArr as $val)
	{
		$re_str .= $val ;
	}
	if(strlen($re_str)>$len)
	{
		$re_str = substr($re_str, 0,$len)."...";
	}
	return $re_str;
}