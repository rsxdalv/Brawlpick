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
        <title>Ban tool form</title>
        <link rel="stylesheet" type="text/css" href="css/entrance.css" />
    </head>
    <body>
        <?php
        include 'system/hashing.php';
        $room = mt_rand(0, 0xFFFFFFF) << 3;
        $token1 = encode_player1($room);
        $token2 = encode_player2($room);
        $token3 = encode_spectator($room);
        $server_name = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL);
        $port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
        if($server_name === 'localhost')
        {
            $URL = "http://".$server_name.":".$port."/bt/room.php?token=";
        } else {
            $URL = "http://".$server_name."/room.php?token=";
        }
        //$baseURL = "http://localhost:8080/bt/room.php?token=";
        $baseURL = "http://draft-rsxdalv.rhcloud.com/room.php?token=";
        ?>
        <div id="wrapper">
        <a class="button" href="<?php echo 'room.php?token='.urlencode($token1); ?>">Player 1</a>
        <a class="button" href="<?php echo 'room.php?token='.urlencode($token2); ?>">Player 2</a>
        <a class="button" href="<?php echo 'room.php?token='.urlencode($token3); ?>">Spectator</a>
        <a class="button" href="enter.php">New room</a>
        <br />
        <table>
            <tr>
                <td>
                    Player 1:  
                </td>
                <td>
                    <input type="text" value="<?php echo $URL.urlencode($token1); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
            <tr>
                <td>
                    Player 2:  
                </td>
                <td>
                    <input type="text" value="<?php echo $URL.urlencode($token2); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
            <tr>
                <td>
                    Spectator:  
                </td>
                <td>
                    <input type="text" value="<?php echo $URL.urlencode($token3); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
        </table>
        </div>
    </body>
</html>
