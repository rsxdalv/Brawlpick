/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function refresher()
{
    dostuffandthings("ref");
    setInterval( function() { dostuffandthings("ref") } , 2500);
}

function getXMLHttpRequest() {
        var request = false;
        try {
                request = new XMLHttpRequest();
        }
        catch(err1) {
                try {
                        request = new ActiveXObject('Msxml2.XMLHTTP');
                }
                catch(err2) {
                        try {
                                request = new ActiveXObject('Microsoft.XMLHTTP');                
                        } 
                        catch(err3) {
                                request = false;
                        }
                }
        }
        return request;
}      

var r;
r = getXMLHttpRequest();

function processResponse() {
        if (r.readyState === 4) {
                if (r.status === 200) {
                        document.getElementById("bantool").innerHTML=r.responseText; 
                };
        };
}

function dostuffandthings(map) {

var id="159";
var p="1";			
var adres="banprocessing.php";
        adres=adres+"?id="+id+"&map="+map+"&p="+p;
        r.open('GET', adres , true);
        r.onreadystatechange = processResponse;
        r.send();
        //r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
}
