<?php
// CONTROLLER
include 'models/Room.class.php';
$token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_URL);
$Room = new Room($token);
$player = $Room->player;
function getPlayerName( $player ) {
    if ($player === 7) {
        return "a spectator";
    } else {
        return "player " . ($player + 1);
    }
}
// VIEW
include 'views/room.php';
?>
