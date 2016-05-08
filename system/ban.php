<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Cache-Control: no-store');

include 'Database.class.php';
include 'Room.class.php';
include 'maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
$step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);
$mapName = filter_input(INPUT_GET, 'map', FILTER_SANITIZE_STRING);

$Room = new Room($token);
$player = $Room->player;
$roomID = $Room->id;
$map = $mapList[$mapName];
assert($map !== NULL);

try{
    switch($step) {
        case 0:
        case 3:
        case 4:
            if($player !== Room::USER_PLAYER1) {
                throw new Exception();
            }
            break;
        case 1:
        case 2:
        case 5:
            if($player !== Room::USER_PLAYER2) {
                throw new Exception();
            }
            break;
        default:
                throw new Exception();
    }
} catch (Exception $ex) {
    echo json_encode( array( 'success' => FALSE, 'step' => $step));
    exit;
}

$step++;

$database = new Database();
echo $database->ban($roomID, $player, $map);