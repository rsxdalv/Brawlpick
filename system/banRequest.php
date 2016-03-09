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
$player = decode_player($token);
$step = filter_input(INPUT_GET, "step", FILTER_SANITIZE_NUMBER_INT);

switch($step) {
    case 0:
    case 3:
    case 4:
        if($player !== 0) {
            echo 'false/step';
            exit();
        }
        break;
    case 1:
    case 2:
    case 5:
        if($player !== 1) {
            echo 'false/step';
            exit();
        }
        break;
    default:
        echo 'false/step';
        exit();
}

$step += 1;
$room = decode_room($token);
$mapName = filter_input(INPUT_GET, "map", FILTER_SANITIZE_STRING);
$map = $mapList[$mapName];
assert($map !== NULL);
$duplicateQuery =   "SELECT *  
                    FROM `ban_list` 
                    WHERE `id` = ".$room.$map." ;";

$result = $db->query($duplicateQuery);
if($result) {
    if($result->num_rows > 0)
    {
        echo json_encode( array(FALSE, $step-1) );
        exit;
    }
    $result->close();
}
else {
    print_db_error($db, $duplicateQuery);
    exit;
}

$insertQuery =    "INSERT INTO `ban_list`
                (`id`, `room`, `player`, `map`, `step`) 
                VALUES ('".($room | $map)."', '".$room."', '".$player."', '".$map."', '".$step."');";

$result2 = $db->query($insertQuery);
if($result2) {
    echo json_encode( array(TRUE, $step) );
} else {
    print_db_error($db, $insertQuery);
    exit;
}