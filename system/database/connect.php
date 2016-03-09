<?php
function print_db_error($db, $query) {
    echo "DB query error. #".$db->errno.": ".$db->error.PHP_EOL;
    echo "Query: ".$query.PHP_EOL;
}

if( getenv('OPENSHIFT_PHP_IP') ) {    
    $mysql_host = getenv(OPENSHIFT_MYSQL_DB_HOST);
    $mysql_database = getenv(OPENSHIFT_APP_NAME);
    $mysql_user = getenv(OPENSHIFT_MYSQL_DB_USERNAME);
    $mysql_password = getenv(OPENSHIFT_MYSQL_DB_PASSWORD);
} else if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $mysql_host = 'localhost';
    $mysql_user = 'root';
    $mysql_password = 'ksex69';
    $mysql_database = 'brawl-draft-pick';
} else {
    include_once 'configuration.php';
}

$db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

if($db->connect_errno)
{
    echo "DB connection error. #".$db->connect_errno.": ".$db->connect_error.PHP_EOL;
}
//
//$database_link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
//
//if (!$database_link) {
//    echo "Error: Unable to connect to MySQL." . PHP_EOL;
//    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//    exit;
//}