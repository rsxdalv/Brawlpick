<?php
include_once 'context.php';
if($_CONTEXT === "SERVER") {
    $mysql_host = "mysql7.000webhost.com";
    $mysql_database = "a1202530_league";
    $mysql_user = "a1202530_lol";
    $mysql_password = "ksex69";
}
else if($_CONTEXT === "DEVELOPMENT-RSX") {
    $mysql_host = "localhost";
    $mysql_database = "brawl-draft-pick";
    $mysql_user = "root";
    $mysql_password = "ksex69";
}
else if($_CONTEXT === "Zychuu") {
    $mysql_host = "mysql.cba.pl";
    $mysql_database = "zychuu_cba_pl";
    $mysql_user = "zychuu97";
    $mysql_password = "<db password here>";
}
else {
    echo "Error: Unknown context!";
}