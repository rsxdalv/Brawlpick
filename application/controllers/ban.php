<?php
header('Cache-Control: no-store');

require_once '../models/Database.php';
require_once '../models/Room.php';
require_once '../models/maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
$mapName = filter_input(INPUT_GET, 'map', FILTER_SANITIZE_STRING);

$Room = new Room($token);
$player = $Room->player;
$roomID = $Room->id;
$map = $mapList[$mapName];

if($map === NULL) {
    echo json_encode ( array( 'success' => FALSE) );
    exit;
}

$database = new Database();
echo $database->ban($roomID, $player, $map);