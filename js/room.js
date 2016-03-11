/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* globals */
var step = 0;
var banCooldown = false;

function init()
{
    synchronize();
    listen();
    //setLoadingAnimation(false);
}

function applyVisualBan(map)
{
    var mapElement = document.getElementById(map);
    mapElement.className = "map banned";
    mapElement.style.backgroundImage = "url('img/maps_banned.jpg')";
    mapElement.setAttribute('onclick', '');
}

function removeVisualBan(map)
{
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
                message(step);
                setLoadingAnimation(false);
            }
        }
    };
    xhttp.open("GET", "system/banRequest.php?token="+token+"&map="+map+"&step="+step, true);
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
                setLoadingAnimation(false);
                // Error code for no-updates
                if(maps[0] === -1) {
                    step = maps[1];
                    message(step);
                    listen();
                } else {
                    step = maps[0];
                    message(step);
                    for(i = 1; i < maps.length; i++)
                        applyVisualBan(maps[i]);
                    listen();
                }
            }
        }
    };
    xhttp.open("GET", "system/listener.php?token="+token+"&step="+step, true);
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
                    message(step);
                } else {
                    step = maps[0];
                    message(step);
                    for(i = 1; i < maps.length; i++)
                        applyVisualBan(maps[i]);
                }
            }
        }
    };
    xhttp.open("GET", "system/synchronize.php?token="+token+"&step="+step, true);
    xhttp.send();
}

/* Messages */
var player1 = ["Your turn to ban 1/6", "Opponent's turn 2/6", "Opponent's turn 3/6", "Your turn 4/6", "Your turn 5/6", "Opponent's turn 6/6", "Bans Finished"];
var player2 = ["Opponent's turn to ban 1/6", "Your turn 2/6", "Your turn 3/6", "Opponent's turn 4/6", "Opponent's turn 5/6", "Your turn 6/6", "Bans Finished"];
var specator = ["Player 1's turn to ban 1/6", "Player 2's turn to ban 2/6", "Player 2's turn to ban 3/6", "Player 1's turn to ban 4/6", "Player 1's turn to ban 5/6", "Player 2's turn to ban 6/6", "Bans Finished"];

function message(step) {
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