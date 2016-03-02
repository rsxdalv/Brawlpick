<?php 
include_once 'dbconnect.php';

$os = filter_input(INPUT_GET, 'os', FILTER_SANITIZE_STRING);
$browser = filter_input(INPUT_GET, 'browsername', FILTER_SANITIZE_STRING);
$fullversion = filter_input(INPUT_GET, 'fullversion');
$ip = filter_input(INPUT_GET, 'ip', FILTER_SANITIZE_STRING);

$winversions = array("Windows NT 5.1" => "Windows XP", "Windows NT 5.2" => "Windows XP/Sever 2003",
                    "Windows NT 6.0" => "Windows Vista", "Windows NT 6.1" => "Windows 7",
                    "Windows NT 6.2" => "Windows 8", "Windows NT 6.3" => "Windows 8.1",
                    "Windows NT 10.0" => "Windows 10");

$simpleOS = strtr($os, $winversions);

$query =    "INSERT INTO `browserdata`
            VALUES ('','$simpleOS','$browsername','$fullversion','$ip') ";

$result = mysqli_query($database_link, $query);

if($result) {
    echo 'true';
}
else {
    echo 'false';
}