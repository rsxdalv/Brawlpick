<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'dbconnect.php';
include 'hashing.php';
include 'maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

$step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

$room = decode_room($token, $key, $method);

$listenQuery = "SELECT `step` 
                FROM `ban_list` 
                WHERE `room` = ? 
                ORDER BY `step` DESC 
                LIMIT 1";

// NB: Sleep time does not mess with PHP's max_execution_time on Linux, while on Windows this might be broken.
if( $stmt = mysqli_prepare($database_link, $listenQuery) ){
    mysqli_stmt_bind_param($stmt, "i", $room);
    //mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $newStep);
    //mysqli_stmt_fetch($stmt);
    for($i = 0; $i < 150; $i++) { // 15 Second execution blocks
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);
//        echo 'new step: '.$newStep . PHP_EOL;
//        echo 'old step: '.$step . PHP_EOL;
        if($newStep > $step) {
//            echo 'STEP REACHED' . PHP_EOL;
            break;
        }
        usleep(33333); // 30 Checks per second
    }
    mysqli_stmt_close($stmt);
    if($newStep > $step)
    {
        //echo 'success stepping in'. PHP_EOL;
        $readQuery =  "SELECT map 
                FROM `ban_list` 
                WHERE `room` = ".$room.";";

        $mysqli_result = mysqli_query($database_link, $readQuery);
        if($mysqli_result)
        {
            $maps = array();
            $maps[0] = $newStep;
            while($row = mysqli_fetch_array($mysqli_result)) {
                    $maps[] = $mapList[$row[0]];
            }

            mysqli_free_result($mysqli_result);
            echo json_encode($maps);
        }
        else
        {
            
            echo 'false/read';
            exit;
        }
    }
    else {
        echo "[-1]"; // JSON Notation
        exit;
    }
}
else {
    echo 'false/stmt';
    exit;
}

