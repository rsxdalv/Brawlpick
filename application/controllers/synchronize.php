<?php
header('Cache-Control: no-store');

require_once '../models/Database.php';
require_once '../models/Room.php';
require_once '../models/maps.php';

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

$Room = new Room($token);
$roomID = $Room->id;

$database = new Database();
echo $database->synchronize($roomID);