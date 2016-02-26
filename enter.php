<?php 
header("Cache-Control: no-store");
?>

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
        $room = mt_rand(0, 0x1FFFFFFF) << 3;
        $token = encode_player1($room, $key, $method);
        $token2 = encode_player2($room, $key, $method);
        $token3 = encode_spectator($room, $key, $method);
        $baseURL = "http://localhost:8080/bt/room.php?token=";
        ?>
        <a href="<?php echo 'room.php?token='.urlencode($token); ?>">Player 1</a><br />
        <a href="<?php echo 'room.php?token='.urlencode($token2); ?>">Player 2</a><br />
        <a href="<?php echo 'room.php?token='.urlencode($token3); ?>">Spectator</a><br />
        Player 2: <input type="text" value="<?php echo $baseURL.urlencode($token2); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly><br />
        Spectator: <input type="text" value="<?php echo $baseURL.urlencode($token3); ?>" id="sample2" onClick="this.setSelectionRange(0, this.value.length)" readonly><br />
    </body>
</html>
