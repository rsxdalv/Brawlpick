<?php


	require("dbconnect.php");

	
	$id=$_GET['id'];
	$map=$_GET['map'];
	$p=$_GET['p'];
	
	if ($map!="ref") {mysql_query("UPDATE sessions SET $map=1, step=step +1 WHERE id='$id' "); }

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
	}
	
	if ( ($step==1 OR $step==4 OR $step==5)  AND $p==1)
	    {
			include("maps-buttons.php");
		}
	
	elseif ( ($step==2 OR $step==3 OR $step==6)  AND $p==2)
	{
		include("maps-buttons.php");
	}
	
	elseif ($step==7)
	{
		include("maps-spect-buttons.php");
	}
	
	else
		
		{
			include("maps-spect-buttons.php");
		}
	
?>