<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = filter_input(INPUT_POST, 'mysql_host', FILTER_SANITIZE_URL);
$login = filter_input(INPUT_POST, 'mysql_login', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'mysql_password', FILTER_SANITIZE_STRING);
$database = filter_input(INPUT_POST, 'mysql_database', FILTER_SANITIZE_STRING);

$file = "configuration.php";
$mode = "w";

$fhandle = fopen($file, $mode);

if ($fhandle) {
    echo 'success/fhandle';
}
else {
    echo 'failure/fhandle';
}

$contents =
'
<?php

$mysql_host = "'.$host.'";
$mysql_database = "'.$database.'";
$mysql_user = "'.$login.'";
$mysql_password = "'.$password.'";
';

$fwrite = fwrite($fhandle, $contents);

if ($fwrite) {
    echo 'success/fwrite';
}
else {
    echo 'failure/fwrite';
}

fclose($fhandle);