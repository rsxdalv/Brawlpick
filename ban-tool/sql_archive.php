<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$create_ban_list_table = 
        "CREATE TABLE `ban_list` (
        `id` int(11) NOT NULL,
        `room` int(11) NOT NULL,
        `player` int(11) NOT NULL,
        `map` int(11) NOT NULL,
        `step` int(11) NOT NULL,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB";


$createBanTable = "CREATE TABLE `brawl-draft-pick`.`ban_rooms` ( `room` INT NOT NULL , `step` INT NOT NULL , `player` INT NOT NULL , `map` INT NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , INDEX (`room`)) ENGINE = InnoDB;";
