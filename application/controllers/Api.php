<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    public function ban() {
        header('Cache-Control: no-store');
        // require_once '../models/Database.php';
        // require_once '../models/Room.php';
        // require_once '../models/maps.php';

        // $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
        // $mapName = filter_input(INPUT_GET, 'map', FILTER_SANITIZE_STRING);

        // $Room = new Room($token);
        // $player = $Room->player;
        // $roomID = $Room->id;
        // $map = $mapList[$mapName];

        // if($map === NULL) {
        //     echo json_encode ( array( 'success' => FALSE) );
        //     exit;
        // }

        // $database = new Database();
        // echo $database->ban($roomID, $player, $map);
    }
    
    public function connect() {
        header('Cache-Control: no-store');

        // require_once '../models/Database.php';
        // require_once '../models/Room.php';

        // $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

        // $Room = new Room($token);
        // $roomID = $Room->id;
        // $player = $Room->player;

        // if($player === Room::USER_SPECTATOR) {
        //     echo json_encode ( array( 'success' => FALSE) );
        //     exit;
        // }

        // $player2 = $Room->getOpponent($player);

        // $database = new Database();
        // if(!$database->checkIn($roomID, $player) ) {
        //     echo json_encode ( false );
        //     exit;
        // }

        // if(!$database->meet($roomID, $player2) ) {
        //     echo json_encode( false );
        //     exit;
        // }

        // if($player === Room::USER_PLAYER1) {
        //     $database->timeout($roomID);
        // }
    }
    
    public function listen() {
        header('Cache-Control: no-store');

        // require_once '../models/Database.php';
        // require_once '../models/Room.php';

        // $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);
        // $step = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

        // $Room = new Room($token);
        // $roomID = $Room->id;

        // $database = new Database();
        // echo $database->listen($roomID, $step);
    }
    
    public function synchronize() {
        header('Cache-Control: no-store');

        // require_once '../models/Database.php';
        // require_once '../models/Room.php';
        // require_once '../models/maps.php';

        // $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_URL);

        // $Room = new Room($token);
        // $roomID = $Room->id;

        // $database = new Database();
        // echo $database->synchronize($roomID);
    }
}