<?php
include_once 'context.php';
if($_CONTEXT==="SERVER") {
    $mysql_host = "mysql7.000webhost.com";
    $mysql_database = "a1202530_league";
    $mysql_user = "a1202530_lol";
    $mysql_password = "ksex69";
}
else if($_CONTEXT==="DEVELOPMENT") {
    $mysql_host = "localhost";
    $mysql_database = "Server2Go";
    $mysql_user = "root";
    $mysql_password = "";
}
else {
    echo "Error: Unknown context!";
}
?>