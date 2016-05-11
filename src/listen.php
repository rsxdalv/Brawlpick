<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Cache-Control: no-store');

include '../models/Database.class.php';
include '../models/Room.class.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
$step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

$Room = new Room($token);
$roomID = $Room->id;

$database = new Database();
echo $database->listen($roomID, $step);