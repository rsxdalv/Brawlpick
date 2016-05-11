<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Cache-Control: no-store');

require_once '../models/Database.php';
require_once '../models/Room.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

$Room = new Room($token);
$roomID = $Room->id;
$player = $Room->player;
$player2 = $Room->getOpponent($player);

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
    