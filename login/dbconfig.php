<?php
session_start();

$DB_host = "mysql08.citynetwork.se";
$DB_user = "111335-ve72158";
$DB_pass = "Sommar11";
$DB_name = "111335-valfrimobil";
	
	
try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$DB_con->exec('SET CHARACTER SET utf8');
}
catch(PDOException $e)
{
	echo $e->getMessage();
}


include_once 'class.user.php';
$user = new USER($DB_con);