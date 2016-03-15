<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of room
 *
 * @author rober
 */
class Room {
    const USER_SPECTATOR = 7;
    const USER_CONNECTED_CODE = 6; // USER_ prefix denotes data storage location
    const USER_PLAYER1 = 0;
    const USER_PLAYER2 = 1;
    
    private static $key = 'A172343B239823C9'; // 16 bytes hexadecimal
    private static $encryption = 'aes-128-cbc'; // Simple AES method
    private static $iv = '1A2B3C4E1A2B3C4E';  // 16 bytes hexadecimal
    
    public $id;
    public $player;
    public $token;
    
    function __construct($token = NULL) {
        if(isset($token)) {
            $this->token = $token;
            $room_and_player = openssl_decrypt( $token , self::$encryption, self::$key, 0, self::$iv);
            $this->id = $room_and_player & 0xFFFFFFF8;
            $this->player = $room_and_player & 0x00000007;
        } else {
            $this->generateId();
        }
    }
    
    public function getToken($player = NULL) {
        if (isset($player)) {
            $this->token = openssl_encrypt( $this->id | $player , self::$encryption, self::$key, 0, self::$iv);
            $this->player = $player;
        }
        return $this->token;
    }
    
    private function generateId() {
        $this->id = mt_rand(0, 0xFFFFFFF) << 3;
    }
}
