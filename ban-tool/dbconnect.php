<?php

	session_start();
mysql_connect("mysql.cba.pl","zychuu97","<db password here>") or die("error with connecting to db");
mysql_select_db("zychuu_cba_pl") or die("error with chosing db");
	mysql_query ('SET NAMES utf8');


?>