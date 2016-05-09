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
    if (player !== 7)
        connect();
    init_countdown();
}

/* Communications */

function updateUI (response) {
    if (response.connected === true) {
        setStep(step);
        setLoadingAnimation(false);
    }
    if (response.updates === true) {
        for (i = 0; i < response.maps.length; i++)
            applyVisualBan(response.maps[i]);
        step = response.step;
        setStep(step);
    }
    listen();
}

// True if player has the right to execute step
function getCurrentPlayer() {
    switch (step) {
        case 0:
        case 3:
        case 4:
            return 0;
            break;
        case 1:
        case 2:
        case 5:
            return 1;
            break;
        default:
            return 7;
    }
}

function ban(map)
{
    if (banCooldown || getCurrentPlayer() !== player)
        return;

    setLoadingAnimation(true);

    $.ajax({
        url: 'system/ban.php',
        data: {
            token: token,
            map: map,
            step: step
        },
        type: 'GET',
        dataType: 'json'
    })
    .done(function (response) {
        banCooldown = false;
        if (response.success === true) {
            applyVisualBan(map);
            step = response.step;
            setStep(step);
            setLoadingAnimation(false);
        }
    });
    banCooldown = true;
}

function listen()
{
    $.ajax({
        url: 'system/listen.php',
        data: {
            token: token,
            step: step
        },
        type: 'GET',
        dataType: 'json'
    }).done( updateUI );
}

function synchronize()
{
    $.ajax({
        url: 'system/synchronize.php',
        data: {
            token: token
        },
        type: 'GET',
        dataType: 'json'
    }).done( updateUI );
}

function connect()
{
    $.ajax({
        url: 'system/connect.php',
        data: {
            token: token
        },
        type: 'GET',
        dataType: 'json'
    }).done(function (data) {
        if(data !== true)
            alert("Error connecting!");
    });
}

/* Visuals */

function setStep(step) {
    resetCountdown();
    if (step === 6) {
        displayMessage("Bans Finished!");
        clearTimeout(timerHandle);
        $('#timer').text('0.0');
    } else {
        var player2 = getCurrentPlayer();
        if (player2 === player) {
            displayMessage('Your turn [' + (step + 1) + '/6]');
        } else {
            displayMessage('Player ' + (player2 + 1) + "'s turn [" + (step + 1) + '/6]');
        }
    }
}

/* Display */
function displayMessage(message) {
    $('#message').text(message);
}

function setLoadingAnimation(state) {
    if (state) {
        $('#overlay').show();
        displayMessage("loading...");
    } else
        $('#overlay').hide();
}

function countdown() {
    var d = new Date();
    var t = timer - d.getTime();
    var s = Math.floor(t / 1000);
    var s10 = Math.floor(t / 100) % 10;
    $('#timer').text(s + '.' + s10);
}

function init_countdown() {
    var d = new Date();
    timer = d.getTime() + 60000;
    timerHandle = setInterval(countdown, 100);
}

function resetCountdown() {
    var d = new Date();
    timer = d.getTime() + 30500;
}

function applyVisualBan(map) {
    $('#' + map).addClass('banned').off();
}

function removeVisualBan(map) {
    $('#' + map).removeClass('banned').click(ban(map));
}