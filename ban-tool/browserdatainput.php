<?php 
include_once 'dbconnect.php';

$os=$_GET['os'];
$browsername=$_GET['browsername'];
$fullversion=$_GET['fullversion'];
$ip=$_GET['ip'];


mysql_query("INSERT INTO browserdata VALUES ('','$os','$browsername','$fullversion','$ip') ");