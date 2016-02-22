<?php 
include_once 'dbconnect.php';

$os=$_GET['os'];
$browsername=$_GET['browsername'];
$fullversion=$_GET['fullversion'];
$ip=$_GET['ip'];

$winversions= array("Windows NT 5.1" => "Windows XP", "Windows NT 5.2" => "Windows XP/Sever 2003",
					"Windows NT 6.0" => "Windows Vista", "Windows NT 6.1" => "Windows 7",
					"Windows NT 6.2" => "Windows 8", "Windows NT 6.3" => "Windows 8.1",
					"Windows NT 10.0" => "Windows 10");

$os=strtr($os, $winversions);
					
mysql_query("INSERT INTO browserdata VALUES ('','$os','$browsername','$fullversion','$ip') ");