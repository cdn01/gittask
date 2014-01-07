<?php
include 'config.php';
$sql = "select * from username where type ='firstname'";
$firstName = mysqlQuery($sql);
foreach ($firstName as $val)
{ 
	$lastNameSql = "select * from username where type='lastname' order by usednum asc  ,rand() limit 1";
	$lastNameRs = mysqlQuery($lastNameSql);
	$insert_user_sql = "insert into user (firstname ,lastname) values ('".$val['name']."','".$lastNameRs[0]['name']."')";
	mysql_query($insert_user_sql);
}