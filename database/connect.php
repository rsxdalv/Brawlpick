<?php
if( getenv('OPENSHIFT_PHP_IP') )
{    
    $mysql_host = getenv(OPENSHIFT_MYSQL_DB_HOST);
    $mysql_database = getenv(OPENSHIFT_APP_NAME);
    $mysql_user = getenv(OPENSHIFT_MYSQL_DB_USERNAME);
    $mysql_password = getenv(OPENSHIFT_MYSQL_DB_PASSWORD);
}
else {
    include_once 'configuration.php';
}

$database_link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

if (!$database_link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}