<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Room.class.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

if(!isset($token)) {
    $roomObj = new Room();
    $token = $roomObj->getToken(Room::USER_PLAYER1);
} else {
    $roomObj = new Room($token);
}

echo "Token: '".$roomObj->token."' <br />";
echo "Room: '".$roomObj->id."' <br />";
echo "Player: '".$roomObj->player."' <br />";