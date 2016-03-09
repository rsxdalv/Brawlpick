<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// spectator is player 8
define("USER_SPECTATOR", 7);
define("USER_PLAYER1", 0);
define("USER_PLAYER2", 1);
        
$key = 'A172343B239823C9';
$method = 'aes-128-cbc';
$iv = '1';

function encode_player1($room) {
    global $key, $method, $iv;
    return openssl_encrypt( $room & 0xFFFFFFFE , $method, $key, 0, $iv);
}

function encode_player2($room) {
    global $key, $method, $iv;
    return openssl_encrypt( $room | 0x00000001 , $method, $key, 0, $iv);
}

function encode_spectator($room) {
    global $key, $method, $iv;
    return openssl_encrypt( $room | 0x00000007 , $method, $key, 0, $iv);
}

function decode_room($token) {
    global $key, $method, $iv;
    return openssl_decrypt($token, $method, $key, 0, $iv) & 0xFFFFFFF8;
}

function decode_player($token) {
    global $key, $method, $iv;
    return openssl_decrypt($token, $method, $key, 0, $iv) & 0x00000007;
}