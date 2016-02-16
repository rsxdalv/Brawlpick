<?php


	session_start();
mysql_connect("mysql.cba.pl","zychuu97","do64k87y") or die("blad laczenia z baza");
mysql_select_db("zychuu_cba_pl") or die("blad z wybieraniem bazy");
	mysql_query ('SET NAMES utf8');
	$id=session_id();
	$query="INSERT INTO sessions VALUES ('$id','0','0','0','0','0','0','0','1') ";
	mysql_query($query);

echo "<a href='bantool.php?id=$id&p=1'> LINK </a> <br>";
echo "Share with opp: http://zychuu.cba.pl/mapban/bantool.php?id=$id&p=2";

session_unset();	
session_destroy();
echo session_id();

?>