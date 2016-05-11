<?php 
// CONTROLLER
header('Cache-Control: no-store');

include 'src/Room.class.php';
$Room = new Room();

$players['Player 1'] = urlencode($Room->getToken(Room::USER_PLAYER1));
$players['Player 2'] = urlencode($Room->getToken(Room::USER_PLAYER2));
$players['Spectator'] = urlencode($Room->getToken(Room::USER_SPECTATOR));

$server_name = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL);
$port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
if($server_name === 'localhost') {
    $URL = 'http://'.$server_name.':'.$port.'/bt/room.php?token=';
} else {
    $URL = 'http://'.$server_name.'/room.php?token=';
}

// VIEW
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
            <?php foreach( $players as $name => $token ) {?>
                <a class="button" href="room.php?token=<?php echo $token ?>"><?php echo $name ?></a>
            <?php }?>
            <a class="button" href="enter.php">New room</a>
            <br />
            <table>
                <?php foreach( $players as $name => $token ) {?>
                <tr>
                    <td><?php echo $name ?>:</td>
                    <td><input type="text" value="<?php echo $URL . $token; ?>" onClick="this.setSelectionRange(0, this.value.length)" readonly="" ><br /></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </body>
</html>