<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Cache-Control: no-store');

include 'database/connect.php';
include 'hashing.php';
include 'maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

$room = decode_room($token);

$listenQuery = 
        'SELECT `step` 
        FROM `ban_list` 
        WHERE `room` = '.$room.'
        ORDER BY `step` DESC 
        LIMIT 1';

$listenResult = $db->query($listenQuery);
if($listenResult) {
    if($listenResult->num_rows > 0)
    {
        $maps = array();
        $maps[0] = $listenResult->fetch_array()[0];
        $readQuery =    
                'SELECT map 
                FROM `ban_list` 
                WHERE `room` = '.$room.';';
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
        echo json_encode( array( NO_UPDATES, NO_MAPS_BANNED ) ); // No maps banned.
        exit;
    }
} else {
    print_db_error($db, $listenQuery);
    exit;
}
