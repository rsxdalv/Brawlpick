<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Control Panel</title>
        <style>
            a.button {
                -webkit-appearance: button;
                -moz-appearance: button;
                appearance: button;

                text-decoration: none;
                color: initial;
                margin: 1px;
                padding: 1px 4px;
            }
        </style>
    </head>
    <body>
        <form action="maintenance.php" method="post" target="_self">
            <fieldset>
                <legend>Database configuration:</legend>
                Database host: <input type="text" value="" name="mysql_host" /><br />
                Database login: <input type="text" value="" name="mysql_login" /><br />
                Database password: <input type="text" value="" name="mysql_password" /><br />
                Database name: <input type="text" value="" name="mysql_database" /><br />
                <input type="hidden" name="action" value="configure" />
                <input type="submit" value="Save" />
            </fieldset>
        </form>
        <br />
        <form action="maintenance.php" method="post" target="_self">
            <fieldset>
                <legend>Maintenance functions</legend>
                <input type="radio" name="action" value="clear" />Clear bans<br />
                <input type="radio" name="action" value="create" />Create bans<br />
                <input type="radio" name="action" value="delete" />Delete bans<br />
                <input type="radio" name="action" value="clear_rooms" />Clear rooms<br />
                <input type="radio" name="action" value="create_rooms" />Create rooms<br />
                <input type="radio" name="action" value="delete_rooms" />Delete rooms<br />
                <input type="radio" name="action" value="tokenDebugger" />Open token debugger<br />
                <input type="submit" value="Execute" />
            </fieldset>
        </form>
        <form>
            <fieldset>
                <legend>Action Response</legend>
        <span id="return"><?php 
            include 'database/dbm.class.php';
            $dbm = new dbm();
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
            switch($action) {
                case 'clear':
                    $dbm->perform(dbm::CLEAR);
                    break;
                case 'create':
                    $dbm->perform(dbm::CREATE);
                    break;
                case 'delete':
                    $dbm->perform(dbm::DELETE);
                    break;
                case 'clear_rooms':
                    $dbm->perform(dbm::CLEAR_ROOMS);
                    break;
                case 'delete_rooms':
                    $dbm->perform(dbm::DELETE_ROOMS);
                    break;
                case 'create_rooms':
                    $dbm->perform(dbm::CREATE_ROOMS);
                    break;
                case 'configure':
                    $host = filter_input(INPUT_POST, 'mysql_host', FILTER_SANITIZE_URL);
                    $login = filter_input(INPUT_POST, 'mysql_login', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'mysql_password', FILTER_SANITIZE_STRING);
                    $database = filter_input(INPUT_POST, 'mysql_database', FILTER_SANITIZE_STRING);
                    $dbm->configure($host, $login, $password, $database);
                    break;
                case 'tokenDebugger':
                    include 'token_debugger.php';
                    echo '<a href="token_debugger.php">link</a>';
                    break;
            }
            ?></span>
            </fieldset>
        </form>
    </body>
</html>
