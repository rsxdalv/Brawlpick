<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../models/Room.class.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

if(!isset($token)) {
    $Room = new Room();
    $token = $Room->getToken(Room::USER_PLAYER1);
} else {
    $Room = new Room($token);
}

echo "Token: '".$Room->token."' <br />";
echo "Room: '".$Room->id."' <br />";
echo "Player: '".$Room->player."' <br />";