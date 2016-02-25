<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
            <title>Map ban tool</title>
            <link rel="Stylesheet" type="text/css" href="style.css" />
            <meta charset="UTF-8">
            <script type="text/javascript">  
                <?php 

                include 'hashing.php';
                $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_URL);
                $player = decode_player($token, $key, $method);

                ?>
                /* globals */
                var token = encodeURIComponent(<?php echo json_encode($token) ?>);
                var player = <?php echo json_encode($player) ?>;
            </script>
            <script type="text/javascript" src="script.js"></script>
            <script type="text/javascript" src="https://code.createjs.com/preloadjs-0.6.2.min.js"></script>
            <script type="text/javascript">
                var queue = new createjs.LoadQueue(true);
                queue.loadFile("img/falls_ban.jpg");
                queue.loadFile("img/fortress_ban.jpg");
                queue.loadFile("img/grove_ban.jpg");
                queue.loadFile("img/hall_ban.jpg");
                queue.loadFile("img/keep_ban.jpg");
                queue.loadFile("img/pass_ban.jpg");
                queue.loadFile("img/stadium_ban.jpg");
            </script>
    </head>
    <body onload='init()'>
        <div id="bantool">
            <div><a id="player">You are player <?php echo ($player+1) ?></a></div>
            <!-- document.getElementById("message_text").innerHTML="test" -->
            <div id="message"><a id="message_text">Message Zone</a></div>
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
        
        <div id="tool">
        </div>
    </body>
</html>