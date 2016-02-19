<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$createBanTable = "CREATE TABLE `brawl-draft-pick`.`ban_rooms` ( `room` INT NOT NULL , `step` INT NOT NULL , `player` INT NOT NULL , `map` INT NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , INDEX (`room`)) ENGINE = InnoDB;";

$insertBanRow = "INSERT INTO `ban_rooms` (`room`, `step`, `player`, `map`, `time`) VALUES ('444', '1', '0', '1', CURRENT_TIMESTAMP);";