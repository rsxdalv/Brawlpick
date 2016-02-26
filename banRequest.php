<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Cache-Control: no-store");

include "hashing.php";
include "database/connect.php";
include "maps.php";

$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_URL);
$mapName = filter_input(INPUT_GET, "map", FILTER_SANITIZE_STRING);
$step = filter_input(INPUT_GET, "step", FILTER_SANITIZE_NUMBER_INT);

$step += 1;

//assert($mapName !== NULL);

$map = $mapList[$mapName];

assert($map !== NULL);

$room = decode_room($token, $key, $method);
$player = decode_player($token, $key, $method); //decode_player($token);

$duplicateQuery =   "SELECT *  
                    FROM `ban_list` 
                    WHERE `id` = ".$room.$map." ;";

if($result = mysqli_query($database_link, $duplicateQuery)) {
    $numDuplicates = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($numDuplicates) {
        echo "Error: Unable to perform SELECT query." . PHP_EOL; // Attempt to ban a banned map.
        mysqli_close($database_link);
        exit;
    }
}
else {
    echo "Error: Unable to perform SELECT query." . PHP_EOL;
    echo "Debugging errno: " . mysqli_errno($database_link) . PHP_EOL;
    echo "Debugging error: " . mysqli_error($database_link) . PHP_EOL;
    mysqli_close($database_link);
    exit;
}

$insertion =    "INSERT INTO `ban_list`
                (`id`, `room`, `player`, `map`, `step`) 
                VALUES ('".$room.$map."', '".$room."', '".$player."', '".$map."', '".$step."');";

$result = mysqli_query($database_link, $insertion);
if($result) {
    echo 'true';
} else {
    echo "Error: Unable to perform INSERT query." . PHP_EOL;
    echo "Debugging errno: " . mysqli_errno($database_link) . PHP_EOL;
    echo "Debugging error: " . mysqli_error($database_link) . PHP_EOL;
}

mysqli_close($database_link);