<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
            <title>Map ban tool</title>
            <link rel="stylesheet" type="text/css" href="css/room.css" />
            <link rel="icon" href="img/icon.ico" />
            <meta charset="UTF-8">
            <script type="text/javascript">  
                <?php 
                include 'system/Room.class.php';
                $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_URL);
                $roomObj = new Room();
                $player = $roomObj->player;
                ?>
                /* globals */
                var token = encodeURIComponent(<?php echo json_encode($token); ?>);
                var player = <?php echo json_encode($player); ?>;
            </script>
            <script type="text/javascript" src="js/room.js"></script>
            <script type="text/javascript" src="https://code.createjs.com/preloadjs-0.6.2.min.js"></script>
            <script type="text/javascript">
                var queue = new createjs.LoadQueue(true);
                queue.loadFile("img/maps_banned.jpg");
            </script>
    </head>
    <body id="body" onload='init()'>
        <div id="overlay"></div>
        <div id="info">
            <span id="player"> <?php if ($player === 7) { echo "You are a spectator"; } else { echo "You are player ".($player+1); } ?> </span>
            <span id="message">loading...</span>
        </div>
        <div id="bantool">
            <div class="map" id="keep" onclick="ban('keep')">Blackguard Keep</div>
            <div class="map" id="pass" onclick="ban('pass')">Kings Pass</div>
            <div class="map" id="fortress" onclick="ban('fortress')">Mammoth Fortress</div>
            <br />
            <div class="map" id="falls" onclick="ban('falls')">Shipwreck Falls</div>
            <br />
            <div class="map" id="hall" onclick="ban('hall')">The Great Hall</div>
            <div class="map" id="stadium" onclick="ban('stadium')">Thundergard Stadium</div>
            <div class="map" id="grove" onclick="ban('grove')">Twilight Grove</div>
            <br />
        </div>
    </body>
</html>