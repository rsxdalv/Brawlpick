/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* globals */
var player, token; // externally assigned globals
var step = 0, banRequested = false;
var timeRemaining, timerHandle;

function init() {
    synchronize();
    if (player !== 7)
        connect();
    cd_init();
}

/* Communications */

function updateUI(response) {
    if (response.connected === true) {
        setStep(step);
        setLoadingAnimation(false);
    }
    if (response.updates === true) {
        foreach (response.maps as map)
            showBan(map)
        // for (i = 0; i < response.maps.length; i++)
        //     showBan(response.maps[i]);
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
        case 1:
        case 2:
        case 5:
            return 1;
        default:
            return 7;
    }
}

function ban(map)
{
    if (banRequested || getCurrentPlayer() !== player)
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
    }).done(function (response) {
        banRequested = false;
        if (response.success === true) {
            showBan(map);
            step = response.step;
            setStep(step);
            setLoadingAnimation(false);
        }
    });
    banRequested = true;
}

function listen() {
    $.ajax({
        url: 'system/listen.php',
        data: {
            token: token,
            step: step
        },
        type: 'GET',
        dataType: 'json'
    }).done(updateUI);
}

function synchronize() {
    $.ajax({
        url: 'system/synchronize.php',
        data: {
            token: token
        },
        type: 'GET',
        dataType: 'json'
    }).done(updateUI);
}

function connect() {
    $.ajax({
        url: 'system/connect.php',
        data: {
            token: token
        },
        type: 'GET',
        dataType: 'json'
    }).done(function (data) {
        if (data !== true)
            alert("Error connecting!");
    });
}

/* Visuals */

function setStep(step) {
    cd_reset();
    if (step === 6) {
        displayMessage("Bans Finished!");
        clearTimeout(timerHandle);
        $('#timer').text('0');
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

// Draft for potential future adaptation
//function timerFactory() {
//    return {
//        timer: null,
//        handle: null,
//        init: function () {
//            timer = new Date().getTime() + 60000;
//            timerHandle = setInterval(this.tick, 500);
//        },
//        tick: function () {
//            document.getElementById('timer').innerHTML.text(
//                    Math.floor(
//                            (timer - new Date().getTime()) / 1000));
//        },
//        reset: function () {
//            timer = new Date().getTime() + 30500;
//        }
//    };
//}

function cd_tick() {
    document.getElementById('timer').innerHTML = (
            Math.floor(
                    (timeRemaining - new Date().getTime()) / 1000));
}

function cd_init() {
    timeRemaining = new Date().getTime() + 60000;
    timerHandle = setInterval(cd_tick, 500);
}

function cd_reset() {
    timeRemaining = new Date().getTime() + 30500;
}

function showBan(map) {
    $('#' + map).addClass('banned').off();
}

function hideBan(map) {
    $('#' + map).removeClass('banned').click(ban(map));
}