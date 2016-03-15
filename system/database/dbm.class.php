<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of dbm (Database Maintenance)
 *
 * @author rober
 */
class dbm {
    // Technically an enum
    const DELETE = 0;
    const CLEAR = 1;
    const CREATE = 2;
    const IMPROVE_BANS = 6;
    const CREATE_ROOMS = 3;
    const DELETE_ROOMS = 4;
    const CLEAR_ROOMS = 5;
    private $db;
    
    public function __construct() {
        if( getenv('OPENSHIFT_PHP_IP') ) {    
            $mysql_host = getenv('OPENSHIFT_MYSQL_DB_HOST');
            $mysql_database = getenv('OPENSHIFT_APP_NAME');
            $mysql_user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
            $mysql_password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
        } else if ($_SERVER['SERVER_NAME'] === 'localhost') {
            $mysql_host = 'localhost';
            $mysql_user = 'root';
            $mysql_password = 'ksex69';
            $mysql_database = 'brawl-draft-pick';
        } else {
            require 'configuration.php';
        }
        
        $this->db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
        if($this->db->connect_errno) {
            echo 'DB connection error. #'.$this->db->connect_errno.': '.$this->db->connect_error.PHP_EOL;
        }
    }
    
    public function perform($queryCode) {
        switch($queryCode) {
            case self::DELETE :
                $query = 'DROP TABLE `ban_list`;';
                break;
            case self::CLEAR :
                $query = 'TRUNCATE TABLE `ban_list`';
                break;
            case self::CREATE :
                $query = 
                        'CREATE TABLE `ban_list` (
                        `id` int(11) NOT NULL,
                        `room` int(11) NOT NULL,
                        `player` int(11) NOT NULL,
                        `map` int(11) NOT NULL,
                        `step` int(11) NOT NULL,
                        PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
                break;
            case self::IMPROVE_BANS :
                $query = 'ALTER TABLE `ban_list` ADD `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `step`;';
                break;
            case self::DELETE_ROOMS :
                $query = 'DROP TABLE `rooms`;'; 
                break;
            case self::CLEAR_ROOMS :
                $query = 'TRUNCATE TABLE `rooms`';
                break;
            case self::CREATE_ROOMS :
                $query = 
                        'CREATE TABLE `rooms` (
                        `id` int(11) NOT NULL,
                        `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`),
                        KEY `id` (`id`)
                       ) ENGINE=InnoDB DEFAULT CHARSET=utf8';
                break;
            default :
                echo 'No Query Specified!' . PHP_EOL;
                exit;
        }
        $result = $this->db->query($query);
        if($result) {
            echo json_encode( TRUE );
        } else {
            echo 'DB query error. #'.$this->db->errno.': '.$this->db->error.PHP_EOL;
            echo 'Query: '.$query.PHP_EOL;
            exit;
        }
    }
    
    public function configure($host, $login, $password, $database) {
        
        $fhandle = fopen("configuration.php", "w");
        if (!$fhandle) {
            echo 'failure/fhandle'.PHP_EOL;
            exit;
        }

        $contents =
                '<?php
                $mysql_host = "'.$host.'";
                $mysql_database = "'.$database.'";
                $mysql_user = "'.$login.'";
                $mysql_password = "'.$password.'";';
        $fwrite = fwrite($fhandle, $contents);
        if (!$fwrite) {
            echo 'failure/fwrite' . PHP_EOL;
            fclose($fhandle);
            exit;
        }

        fclose($fhandle);
    }
}    
