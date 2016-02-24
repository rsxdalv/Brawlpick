<?php

if( isset($OPENSHIFT_MYSQL_DB_HOST) )
{
    $database_link = mysqli_connect($OPENSHIFT_MYSQL_DB_HOST, $OPENSHIFT_MYSQL_DB_USER, $OPENSHIFT_MYSQL_DB_PASSWORD, $OPENSHIFT_MYSQL_DB_DATABASE);
}
else
{
    include_once 'configuration.php';

    $database_link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

    if (!$database_link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
}


