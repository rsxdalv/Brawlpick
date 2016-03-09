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

$room = decode_room($token);

$listenQuery = "SELECT `step` 
                FROM `ban_list` 
                WHERE `room` = ? 
                ORDER BY `step` DESC 
                LIMIT 1";

if( $stmt = mysqli_prepare($database_link, $listenQuery) ){
    mysqli_stmt_bind_param($stmt, "i", $room);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $newStep);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    $readQuery =  "SELECT map 
            FROM `ban_list` 
            WHERE `room` = ".$room.";";

    if ($newStep === null) {
        $newStep = 0;
    }
    
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
        exit;
    }
    else
    {
        echo 'false/read';
        mysqli_close($database_link);
        exit;
    }
    
    echo json_encode(array(-1, $newStep));
    exit;
}
else {
    echo 'false/stmt';
    exit;
}

mysqli_close($database_link);
