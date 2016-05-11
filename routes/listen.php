<?php
header('Cache-Control: no-store');

require_once '../models/Database.php';
require_once '../models/Room.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
$step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

$Room = new Room($token);
$roomID = $Room->id;

$database = new Database();
echo $database->listen($roomID, $step);