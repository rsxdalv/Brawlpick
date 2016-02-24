<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'connect.php';

$delete_ban_list_table = "DROP TABLE `ban_list`;";

$mysqli_query = mysqli_query($database_link, $delete_ban_list_table);

if($mysqli_query) {
    echo 'success/table_deleted'.PHP_EOL;
}
else {
    echo 'failure/table_deleted'.PHP_EOL;
}

mysqli_close($database_link);