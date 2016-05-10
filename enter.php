<?php 
header('Cache-Control: no-store');
include 'system/Room.class.php';
$Room = new Room();
$token1 = urlencode($Room->getToken(Room::USER_PLAYER1));
$token2 = urlencode($Room->getToken(Room::USER_PLAYER2));
$token3 = urlencode($Room->getToken(Room::USER_SPECTATOR));
$server_name = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL);
$port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
if($server_name === 'localhost') {
    $URL = 'http://'.$server_name.':'.$port.'/bt/room.php?token=';
} else {
    $URL = 'http://'.$server_name.'/room.php?token=';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Draft Pick Mode</title>
        <link rel="stylesheet" type="text/css" href="css/entrance.css" />
    </head>
    <body>
        <div id="wrapper">
            <a class="button" href="room.php?token=<?php echo $token1?>">Player 1</a>
            <a class="button" href="room.php?token=<?php echo $token2?>">Player 2</a>
            <a class="button" href="room.php?token=<?php echo $token3?>">Spectator</a>
            <a class="button" href="enter.php">New room</a>
            <br />
            <table>
                <tr>
                    <td>Player 1:</td>
                    <td><input type="text" value="<?php echo $URL.$token1; ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br /></td>
                </tr> <tr>
                    <td>Player 2:</td>
                    <td><input type="text" value="<?php echo $URL.$token2; ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br /></td>
                </tr> <tr>
                    <td>Spectator:</td>
                    <td><input type="text" value="<?php echo $URL.$token3; ?>" id="sample1" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br /></td>
                </tr> 
            </table>
        </div>
    </body>
</html>
