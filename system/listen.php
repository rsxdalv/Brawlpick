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

$roomObj = new Room($token);
$room = $roomObj->id;

$database = new Database();
echo $database->listen($room, $step);