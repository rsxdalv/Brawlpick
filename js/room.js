/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* globals */
var player, token; // externally assigned globals
var step = 0, banCooldown = false, timer, timerHandle;

function init() {
    synchronize();
    listen();
    if(player !== 7)
        connect();
    init_countdown();
}

function countdown() {
    var d = new Date();
    var t = timer - d.getTime();
    var s = Math.floor( t/1000 );
    var s10 = Math.floor( t/100 ) % 10;
    document.getElementById("timer").innerHTML = s + "." + s10;
}

function init_countdown() {
    resetCountdown();
    timerHandle = setInterval(countdown, 100);
}

function resetCountdown() {
    var d = new Date();
    timer = d.getTime() + 15000;
}

function applyVisualBan(map) {
    var mapElement = document.getElementById(map);
    mapElement.className = "map banned";
    mapElement.style.backgroundImage = "url('img/maps_banned.jpg')";
    mapElement.setAttribute('onclick', '');
}

function removeVisualBan(map) {
    var mapElement = document.getElementById(map);
    mapElement.className = "map";
    mapElement.style.backgroundImage = "url('img/maps.jpg')";
    mapElement.setAttribute('onclick', 'ban('+map+')');
}

function ban(map)
{
    if(player === 7 || banCooldown)
        return;
    
    switch(step) {
        case 0:
        case 3:
        case 4:
            if(player !== 0)
                return;
            break;
        case 1:
        case 2:
        case 5:
            if(player !== 1)
                return;
            break;
        default:
            return;
    }
    
    setLoadingAnimation(true);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === 4 && xhttp.status === 200)
        {
            banCooldown = false;
            var response = JSON.parse(xhttp.response);
            if(response[0] === true)
            {
                applyVisualBan(map);
                step = response[1];
                update(step);
                setLoadingAnimation(false);
            }
        }
    };
    xhttp.open("GET", "system/ban.php?token="+token+"&map="+map+"&step="+step, true);
    xhttp.send();
    banCooldown = true;
}

function listen()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === 4 && xhttp.status === 200) {
            if(xhttp.response !== 'false')
            {
                var maps = JSON.parse(xhttp.response);
                // Error code for no-updates
                if(maps[0] === -1) {
                    step = maps[1];
                    update(step);
                    listen();
                } else {
                    step = maps[0];
                    update(step);
                    for(i = 1; i < maps.length; i++)
                        applyVisualBan(maps[i]);
                    listen();
                }
            }
        }
    };
    xhttp.open("GET", "system/listen.php?token="+token+"&step="+step, true);
    xhttp.send();
}

function synchronize()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === 4 && xhttp.status === 200) {
            if(xhttp.response !== 'false')
            {
                var maps = JSON.parse(xhttp.response);
                setLoadingAnimation(false);
                // Error code for no-updates
                if(maps[0] === -1) {
                    step = maps[1];
                    update(step);
                } else {
                    step = maps[0];
                    update(step);
                    for(i = 1; i < maps.length; i++)
                        applyVisualBan(maps[i]);
                }
            }
        }
    };
    xhttp.open("GET", "system/synchronize.php?token="+token+"&step="+step, true);
    xhttp.send();
}

function connect()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === 4 && xhttp.status === 200) {
            if(JSON.parse(xhttp.response) !== true) {
                alert("Error connecting!");
            }
        }
    };
    xhttp.open("GET", "system/connect.php?token="+token, true);
    xhttp.send();
}

/* Messages */
var player1 = ["Your turn to ban 1/6", "Opponent's turn 2/6", "Opponent's turn 3/6", "Your turn 4/6", "Your turn 5/6", "Opponent's turn 6/6"];
var player2 = ["Opponent's turn to ban 1/6", "Your turn 2/6", "Your turn 3/6", "Opponent's turn 4/6", "Opponent's turn 5/6", "Your turn 6/6"];
var specator = ["Player 1's turn to ban 1/6", "Player 2's turn to ban 2/6", "Player 2's turn to ban 3/6", "Player 1's turn to ban 4/6", "Player 1's turn to ban 5/6", "Player 2's turn to ban 6/6"];

function update(step) {
    resetCountdown();
    if(step === 6) {
        displayMessage("Bans Finished!");
        clearTimeout(timerHandle);
        document.getElementById("timer").innerHTML = "0.0";
    } else {
        switch(player) {
            case 0:
                displayMessage(player1[step]);
                break;
            case 1:
                displayMessage(player2[step]);
                break;
            default:
                displayMessage(specator[step]);
                break;
        }
    }
}

function displayMessage(message) {
    document.getElementById("message").innerHTML = message;
}

function setLoadingAnimation(state) {
    if(state) {
        document.getElementById("overlay").style.display = "block";
        displayMessage("loading...");
    }
    else
        document.getElementById("overlay").style.display = "none";
}