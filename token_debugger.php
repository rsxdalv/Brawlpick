<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'hashing.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

echo "Token: !".$token."! <br />";

$room = decode_room($token, $key, $method);
$player = decode_player($token, $key, $method);

echo "Room: !".$room."! <br />";
echo "Player: !".$player."! <br />";


