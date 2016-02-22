<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'dbconnect.php';


$query = "DELETE FROM `ban_list`";

$result = mysqli_query($database_link, $query);

echo 'STATUS: ' . $result . PHP_EOL;