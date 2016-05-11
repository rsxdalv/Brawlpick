<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Draft Pick Mode</title>
        <link rel="stylesheet" type="text/css" href="public/css/entrance.css" />
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