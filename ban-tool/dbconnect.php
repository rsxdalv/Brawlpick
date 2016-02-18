<?php
include_once 'system/mysql.php';

session_start();

mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("error with connecting to db");

mysql_select_db($mysql_database) or die("error with chosing db");

mysql_query ('SET NAMES utf8');

