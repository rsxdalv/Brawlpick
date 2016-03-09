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
        <style type="text/css">
            a.button {
                -webkit-appearance: button;
                -moz-appearance: button;
                appearance: button;

                display:inline-block;
                text-decoration: none;
                color: initial;
                margin: 3px 1px;
                padding: 1px;
            }
            
            #sample1, #sample2 {
                width: 475px;
            }
            
            body {
                background-color: #202030;
                text-align: center;
                color: #e0e0e0;
            }
            
            div#wrapper {
                padding: 10px 10px;
                margin-bottom: 20px;
                background-color: #282850;
                border-radius: 10px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <?php
        include 'system/hashing.php';
        $room = mt_rand(0, 0xFFFFFFF) << 3;
        $token1 = encode_player1($room);
        $token2 = encode_player2($room);
        $token3 = encode_spectator($room);
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
                    <input type="text" value="<?php echo $baseURL.urlencode($token1); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
            <tr>
                <td>
                    Player 2:  
                </td>
                <td>
                    <input type="text" value="<?php echo $baseURL.urlencode($token2); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
            <tr>
                <td>
                    Spectator:  
                </td>
                <td>
                    <input type="text" value="<?php echo $baseURL.urlencode($token3); ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br />  
                </td>
            </tr> 
        </table>
        </div>
    </body>
</html>
