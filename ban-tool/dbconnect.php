<?php
include_once 'system/sql.php';
file_exists('system/db_info.php') AND include_once 'system/db_info.php';

$database_link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

if (!$database_link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


