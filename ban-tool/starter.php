<?php



require("dbconnect.php");
	
$id=$_POST['id'];
$p=$_POST['p'];
$query="INSERT INTO sessions VALUES ('$id','0','0','0','0','0','0','0','1') ";
mysql_query($query);

if ( $p == 1 ) {
    echo "Link for you: <a href='bantool.php?id=$id&p=1'> LINK </a> <br>
        Share with opp: http://zychuu.cba.pl/mapban/bantool.php?id=$id&p=2 <br>";
}
echo "Spect link: http://zychuu.cba.pl/mapban/bantool.php?id=$id&p=3";

session_unset();	
session_destroy();
echo session_id();
