<?php
/**
 * Description of room
 *
 * @author rober
 */
class Room extends CI_Model {


    const USER_PLAYER1 = 0;
    const USER_PLAYER2 = 1;
    const USER_SPECTATOR = 7;
    const USER_BOT = 6;
    const USER_CONNECTED_CODE = 5; // USER_ prefix denotes data storage location

    // DISCLAIMER: DO NOT USE THE DEFAULT KEYS AS THEY ARE FREELY VISIBLE!
    private static $key = 'A172343B239823C9'; // 16 bytes hexadecimal
    private static $encryption = 'aes-128-cbc'; // Simple AES method
    private static $iv = '1A2B3C4E1A2B3C4E';  // 16 bytes hexadecimal
    
    public $id;
    public $player;
    public $token;

    function __construct()
    {
        parent::__construct();
        $this->generateId();
    }

    function loadToken($token) {
        $this->token = $token;
        $room_and_player = openssl_decrypt($token, self::$encryption, self::$key, 0, self::$iv);
        $this->id = $room_and_player & 0xFFFFFFF8;
        $this->player = $room_and_player & 0x00000007;
    }

    public function getToken($player = NULL) {
        if (isset($player)) {
            $this->token = openssl_encrypt($this->id | $player, self::$encryption, self::$key, 0, self::$iv);
            $this->player = $player;
        }
        return $this->token;
    }

    private function generateId() {
        $this->id = mt_rand(0, 0xFFFFFFF) << 3;
    }

    public function validate($step) {
        if ($step > 6) {
            return false;
        }
        if ($this->player === self::USER_BOT) {
            return true;
        }
        switch ($step) {
            case 1:
            case 4:
            case 5:
                if ($this->player !== self::USER_PLAYER1) {
                    return false;
                }
                break;
            case 2:
            case 3:
            case 6:
                if ($this->player !== self::USER_PLAYER2) {
                    return false;
                }
                break;
            default:
                return false;
        }
        return true;
    }
    
    public function getOpponent($player) {
        switch($player) {
            case Room::USER_PLAYER1 :
                return Room::USER_PLAYER2;
            case Room::USER_PLAYER2 :
                return Room::USER_PLAYER1;
            default :
                return -1;
        }
    }
}
