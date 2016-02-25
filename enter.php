<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'hashing.php';
        $room = mt_rand(0, 0xFFFFFFFF) & 0xFFFFFFFE;
        //$room = 556;
        $token = encode_player1($room, $key, $method);
        $token2 = encode_player2($room, $key, $method);
        ?>
        <a href="<?php echo 'room.php?token='.urlencode($token); ?>">Player 1</a>
        <a href="<?php echo 'room.php?token='.urlencode($token2); ?>">Player 2</a>
        <input type="text" value="<?php echo 'room.php?token='.urlencode($token2); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly>
    </body>
</html>
