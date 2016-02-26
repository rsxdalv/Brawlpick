<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$key = 'A172343B239823C9';
$method = 'aes-128-cbc';

function encode_player1($room, $key, $method) {
    //echo 'key:' . $key . ' method:' .$method;
    return openssl_encrypt($room & 0xFFFFFFFE, $method, $key);
}

function encode_player2($room, $key, $method) {
    return openssl_encrypt($room | 0x00000001, $method, $key);
}

// spectator is player 8
function encode_spectator($room, $key, $method) {
    return openssl_encrypt($room | 0x00000007, $method, $key);
}

function decode_room($token, $key, $method) {
    return openssl_decrypt($token, $method, $key) & 0xFFFFFFF8;
}

function decode_player($token, $key, $method) {
    return openssl_decrypt($token, $method, $key) & 0x00000007;
}