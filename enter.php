<?php 
// CONTROLLER
header('Cache-Control: no-store');

include 'models/Room.php';
$Room = new Room();

$players['Player 1'] = urlencode($Room->getToken(Room::USER_PLAYER1));
$players['Player 2'] = urlencode($Room->getToken(Room::USER_PLAYER2));
$players['Spectator'] = urlencode($Room->getToken(Room::USER_SPECTATOR));

$server_name = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL);
$port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
if($server_name === 'localhost') {
    $URL = 'http://'.$server_name.':'.$port.'/bt/room.php?token=';
} else {
    $URL = 'http://'.$server_name.'/room.php?token=';
}

// VIEW
include 'views/enter.php';
?>

