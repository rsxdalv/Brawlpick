<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Cache-Control: no-store");

include 'database/connect.php';
include 'hashing.php';
include 'maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
$step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);
$room = decode_room($token);

$listenQuery = 
        "SELECT `step` 
        FROM `ban_list` 
        WHERE `room` = ? 
        ORDER BY `step` DESC 
        LIMIT 1";

// NB: Sleep time does not mess with PHP's max_execution_time on Linux, while on Windows this might be broken.
$stmt = $db->prepare($listenQuery);
if($stmt) 
{
    $stmt->bind_param("i", $room);
    $stmt->bind_result($newStep);
    for($i = 0; $i < 150; $i++) { // 15 Second execution blocks
        $stmt->execute();
        $stmt->fetch();
//        echo 'new step: '.$newStep . PHP_EOL;
//        echo 'old step: '.$step . PHP_EOL;
        if($newStep > $step) {
//            echo 'STEP REACHED' . PHP_EOL;
            break;
        }
        usleep(33333); // 30 Checks per second
    }
    $stmt->close();
    if($newStep > $step)
    {
        $maps = array();
        $maps[0] = $newStep;
        $readQuery =    
                "SELECT map 
                FROM `ban_list` 
                WHERE `room` = ".$room.";";
        $readResult = $db->query($readQuery);
        if($readResult) {
            while($row = $readResult->fetch_array())
            {
                $maps[] = $mapList[$row[0]];
            }
            $readResult->close();
            echo json_encode($maps);
            exit;
        } else {
            print_db_error($db, $readQuery);
            exit;
        }
    }
    else {
        echo json_encode( array( NO_UPDATES, $newStep ) ); // No maps banned.
        exit;
    }
}
else {
    print_db_error($db, $listenQuery);
    exit;
}
