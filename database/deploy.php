<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'connect.php';

$create_ban_list_table = 
        "CREATE TABLE `ban_list` (
        `id` int(11) unsigned NOT NULL,
        `room` int(11) NOT NULL,
        `player` int(11) NOT NULL,
        `map` int(11) NOT NULL,
        `step` int(11) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";


$mysqli_query = mysqli_query($database_link, $create_ban_list_table);

if($mysqli_query) {
    echo 'success/table_created'.PHP_EOL;
}
else {
    echo 'failure/table_created'.PHP_EOL;
}

mysqli_close($database_link);