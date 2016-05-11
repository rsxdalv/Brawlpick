<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Cache-Control: no-store');

include 'Database.class.php';
include '../models/Room.class.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

$Room = new Room($token);
$roomID = $Room->id;
$player = $Room->player;
$player2 = 0;
switch($player) {
    case Room::USER_SPECTATOR :
        exit;
    case Room::USER_PLAYER1 :
        $player2 = Room::USER_PLAYER2;
        break;
    case Room::USER_PLAYER2 :
        $player2 = Room::USER_PLAYER1;
        break;
}

$database = new Database();
if(!$database->checkIn($roomID, $player) ) {
    echo json_encode ( false );
    exit;
}

if(!$database->meet($roomID, $player2) ) {
    echo json_encode( false );
    exit;
}

if($player === Room::USER_PLAYER1) {
    $database->timeout($roomID);
}
    