<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "hashing.php";

$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_URL);
$mapName = filter_input(INPUT_GET, "map", FILTER_SANITIZE_STRING);

//assert($mapName !== NULL);

$mapList = [keep => '1', pass => '2', fortress => '3', falls => '4', hall => '5', stadium => '6', grove => '7', 
    1 => 'keep', 2 => 'pass', 3 => 'fortress', 4 => 'falls', 5 => 'hall', 6 => 'stadium', 7 => 'grove'];

$map = $mapList[$mapName];

//assert($map !== NULL);

$room = decode_room($token, $key, $method);
$player = decode_player($token, $key, $method); //decode_player($token);
$step = 1;

//assert($token === $token); // Verify banning power

$query = "INSERT INTO `ban_rooms` (`room`, `step`, `player`, `map`, `time`) VALUES ('".$room."', '".$step."', '".$player."', '".$map."', CURRENT_TIMESTAMP);";

echo 'true';