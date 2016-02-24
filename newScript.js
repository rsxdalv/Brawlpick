/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* globals */
var step = 0;
var token = null;
var banCooldown = false;

function init()
{
    token = encodeURIComponent("N9KoXJgiU5KNJG/iM3H4xA==");
    listen();
}

function removeVisualBan(map)
{
    var mapElement = document.getElementById(map);
    mapElement.className = "map";
    mapElement.style.backgroundImage = "url('img/"+map+".jpg')";
    mapElement.setAttribute('onclick', 'ban('+map+')');
}

function applyVisualBan(map)
{
    var mapElement = document.getElementById(map);
    mapElement.className += " banned";
    mapElement.style.backgroundImage = "url('img/"+map+"_ban.jpg')";
    mapElement.setAttribute('onclick', '');
}

function ban(map)
{
    if(banCooldown) return;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function confirmBan(){
        if(xhttp.readyState === 4 && xhttp.status === 200)
        {
            banCooldown = false;
            if(xhttp.response === "true")
            {
                applyVisualBan(map);
                step += 1;
            }
        }
    };
    xhttp.open("GET", "banRequest.php?token="+token+"&map="+map+"&step="+step, true);
    xhttp.send();
    banCooldown = true;
}

function listen()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function hear(){
        if(xhttp.readyState === 4 && xhttp.status === 200) {
            if(xhttp.response !== 'false')
            {
                maps = JSON.parse(xhttp.response);
                // Error code for no-updates
                if(maps[0] === -1) {
                    listen();
                }
                else {
                    step = maps[0];
                    for(i = 1; i < maps.length; i++)
                        applyVisualBan(maps[i]);
                    listen(); // Should be delayed by about 1000ms by server
                }
            }
        }
    };
    xhttp.open("GET", "listener.php?token="+token+"&step="+step, true);
    xhttp.send();
}