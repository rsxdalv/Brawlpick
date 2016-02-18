/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function applyVisualBan(map)
{
    document.getElementById(map).style.backgroundImage = "url('img/".concat(map).concat("_ban.jpg')");
}