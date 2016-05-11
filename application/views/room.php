<!DOCTYPE html>
<html>
    <head>
        <title>Draft Pick Mode</title>
        <link rel="stylesheet" type="text/css" href="/app/public/css/room.css" />
        <link rel="icon" href="/app/public/img/icon.ico" />
        <meta charset="UTF-8">
    </head>
    <body id="body" onload='init()'>
        <div id="overlay"></div>
        <div id="info">
            <span id="player"> 
                You are 
                <?php
                    echo $playerName;
                ?> 
            </span>
            <span id="message">Waiting for players... </span>
            <span id="timer">60</span>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript">
            /* globals */
            var auth = <?php echo $token; ?>;
            var player = <?php echo $player; ?>;
        </script>
        <script type="text/javascript" src="/app/public/js/room.js"></script>
        <script type="text/javascript" src="https://code.createjs.com/preloadjs-0.6.2.min.js"></script>
        <script type="text/javascript">
            var queue = new createjs.LoadQueue(true);
            queue.loadFile("/app/public/img/maps_banned.jpg");
        </script>
        </div>
    </body>
</html>