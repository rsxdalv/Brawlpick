/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function removeVisualBan(map)
{
    mapElement = document.getElementById(map);
    mapElement.className = "map";
    mapElement.style.backgroundImage = "url('img/"+map+".jpg')";
    mapElement.setAttribute('onclick', 'ban('+map+')');
}

function applyVisualBan(map)
{
    mapElement = document.getElementById(map);
    mapElement.className += " banned";
    mapElement.style.backgroundImage = "url('img/"+map+"_ban.jpg')";
    mapElement.setAttribute('onclick', '');
}

function ban(map)
{
    xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function(){
//        if(xhttp.readyState === 4 && xhttp.status === 200)
//            if(xhttp.response === "true")
//                removeVisualBan(map);
//    };
    token = encodeURIComponent("N9KoXJgiU5KNJG/iM3H4xA==");
    xhttp.open("GET", "banRequest.php?token="+token+"&map="+map, true);
    xhttp.send();
}

function listener()
{
    listen();
}

function listen()
{
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function hear(){
        if(xhttp.readyState === 4 && xhttp.status === 200) {
            if(xhttp.response !== 'false')
            {
                maps = JSON.parse(xhttp.response);
                for(i = 0; i < maps.length; i++) {
                    applyVisualBan(maps[i]);
                }
                listen(); // Should be delayed by about 1000ms by server
            }
        }
    };
    // txt cache
    token = encodeURIComponent("N9KoXJgiU5KNJG/iM3H4xA==");
    xhttp.open("GET", "listener.php?token="+token+"&step=0", true);
    xhttp.send();
}