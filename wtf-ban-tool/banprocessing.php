<?php


	session_start();
mysql_connect("mysql.cba.pl","zychuu97","<well there was my pass xD>") or die("error with connecting to db");
mysql_select_db("zychuu_cba_pl") or die("error with chosing db");
	mysql_query ('SET NAMES utf8');

	
	$id=$_GET['id'];
	$map=$_GET['map'];
	
	if ($map!="ref") {mysql_query("UPDATE sessions SET $map=1 WHERE id='$id' "); }

	$select=mysql_query("SELECT * FROM sessions where id='$id' ");

	while ($row=mysql_fetch_array($select)) 
	{
	$blackguard=$row['blackguard'];
	$kings=$row['kings'];
	$mammoth=$row['mammoth'];
	$shipwreck=$row['shipwreck'];
	$shithall=$row['shithall'];
	$stadium=$row['stadium'];
	$twillight=$row['twillight'];
	$step=$row['step'];
	
		if ($blackguard==0)
		{
			echo "<div id=\"blackguard\"><img src=\"pic/blackguard.jpg\" onclick='dostuffandthings(\"blackguard\")'></div>" ;
		}
		else {echo "<div id=\"blackguard\"><img src=\"pic/blackguardban.jpg\"></div>";}
		
		if ($kings==0)
		{
			echo "<div id=\"kings\"><img src=\"pic/kings.jpg\" onclick='dostuffandthings(\"kings\")'></div>" ;
		}
		else {echo "<div id=\"kings\"><img src=\"pic/kingsban.jpg\"></div>";}
		
		if ($mammoth==0)
		{
			echo "<div id=\"mammoth\"><img src=\"pic/mammoth.jpg\" onclick='dostuffandthings(\"mammoth\")'></div>" ;
		}
		else {echo "<div id=\"mammoth\"><img src=\"pic/mammothban.jpg\"></div>";}
		
		if ($shipwreck==0)
		{
			echo "<div id=\"shipwreck\"><img src=\"pic/shipwreck.jpg\" onclick='dostuffandthings(\"shipwreck\")'></div>" ;
		}
		else {echo "<div id=\"shipwreck\"><img src=\"pic/shipwreckban.jpg\"></div>";}
		
		if ($shithall==0)
		{
			echo "<div id=\"shithall\"><img src=\"pic/shithall.jpg\" onclick='dostuffandthings(\"shithall\")'></div>" ;
		}
		else {echo "<div id=\"shithall\"><img src=\"pic/shithallban.jpg\"></div>";}
		
		if ($stadium==0)
		{
			echo "<div id=\"stadium\"><img src=\"pic/stadium.jpg\" onclick='dostuffandthings(\"stadium\")'></div>" ;
		}
		else {echo "<div id=\"stadium\"><img src=\"pic/stadiumban.jpg\"></div>";}
		
		if ($twillight==0)
		{
			echo "<div id=\"twillight\"><img src=\"pic/twillight.jpg\" onclick='dostuffandthings(\"twillight\")'></div>" ;
		}
		else {echo "<div id=\"twillight\"><img src=\"pic/twillightban.jpg\"></div>";}
		
	}
?>