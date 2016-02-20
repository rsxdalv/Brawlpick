/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function removeVisualBan(map)
{
    mapElement = document.getElementById(map);
    mapElement.className = "map";
    mapElement.style.backgroundImage = "url('img/".concat(map).concat(".jpg')");
    mapElement.setAttribute('onclick', 'ban('+map+')');
}

function applyVisualBan(map)
{
    mapElement = document.getElementById(map);
    mapElement.className += " banned";
    mapElement.style.backgroundImage = "url('img/".concat(map).concat("_ban.jpg')");
    mapElement.setAttribute('onclick', '');
}

function ban(map)
{
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.response === "true")
            applyVisualBan(map);
    };
    token = encodeURIComponent("N9KoXJgiU5KNJG/iM3H4xA==");
    
    xhttp.open("GET", "banRequest.php?token="+token+"&map="+map, true);
    xhttp.send();
}

function listen()
{
    map = 'pass';
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        applyVisualBan(xhttp.response);
    }
    token = encodeURIComponent("N9KoXJgiU5KNJG/iM3H4xA==");
    
    xhttp.open("GET", "banRequest.php?token="+token+"&map="+map, true);
    xhttp.send();
}