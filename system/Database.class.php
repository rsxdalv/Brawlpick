<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of database
 *
 * @author rober
 */
class Database {
    const BAN_TIMEOUT = 15000000;
    const NO_MAPS_BANNED = 0;
    const NO_UPDATES = -1;

    private $db;
    
    private static $mapList = array('keep' => 1, 'pass' => 2, 'fortress' => 3, 'falls' => 4, 'hall' => 5, 'stadium' => 6, 'grove' => 7, 
            '1' => 'keep', '2' => 'pass', '3' => 'fortress', '4' => 'falls', '5' => 'hall', '6' => 'stadium', '7' => 'grove');

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
    
    public function validate($step, $player) {
        switch($step) {
            case 1:
            case 4:
            case 5:
                if($player !== Room::USER_PLAYER1) {
                    return false;
                }
                break;
            case 2:
            case 3:
            case 6:
                if($player !== Room::USER_PLAYER2) {
                    return false;
                }
                break;
            default:
                return false;
        }
        return true;
    }
    
    public function ban($room, $player, $map) {
        
        $step = $this->getStep($room);
        if($step === NULL) {
            $step = 1;
        } else {
            $step++;
        }
        
        if(!$this->validate($step, $player)) {
            return json_encode( array( 'success' => FALSE, 'step' => $step));
        }
        
        $duplicateQuery =   
                'SELECT *  
                FROM `ban_list` 
                WHERE `id` = '.($room | $map).';';
        
        $result = $this->query($duplicateQuery);
        if($result->num_rows > 0) {
            return json_encode( array( 'success' => FALSE, 'step' => $step-1));
        }
        $result->close();

        $insertQuery =    
                'INSERT INTO `ban_list`
                (`id`, `room`, `player`, `map`, `step`) 
                VALUES ("'.($room | $map).'", "'.$room.'", "'.$player.'", "'.$map.'", "'.$step.'");';

        $this->query($insertQuery);
        return json_encode( array( 'success' => TRUE, 'step' => $step));
    }
    
    public function getStep($room) {
        $stepQuery = 
                'SELECT `step` 
                FROM `ban_list` 
                WHERE `room` = '.$room.'
                ORDER BY `step` DESC 
                LIMIT 1';
        
        $stepResult = $this->query($stepQuery);
        if($stepResult->num_rows > 0) {
            return $stepResult->fetch_array()[0];
        } else {
            return NULL;
        }
    }
    
    public function listen($room, $step) {
        $listenQuery = 
                'SELECT `step` 
                FROM `ban_list` 
                WHERE `room` = '.$room.' 
                ORDER BY `step` DESC 
                LIMIT 1';

        // NB: Sleep time does not mess with PHP's max_execution_time on Linux, while on Windows this might be broken.
        $stmt = $this->db->prepare($listenQuery);
        $newStep = 0;
        if($stmt) 
        {
            $stmt->bind_result($newStep);
            for($i = 0; $i < 450; $i++) { // 15 Second execution blocks
                $stmt->execute();
                $stmt->fetch();
                if($newStep > $step) {
                    break;
                }
                usleep(33333); // 30 Checks per second
            }
            $stmt->close();
            if($newStep > $step) {
                $maps = $this->getBans($room);
                return json_encode( array( 'updates' => true, 'step' => $newStep, 'maps' => $maps) );
            } else {
                //NB: No longer passing step in response due to improved sync with bans.
                return json_encode( array( 'updates' => false ) ); // No maps banned.
            }
        } else {
            $this->error($listenQuery);
        }
    }
    
    public function synchronize($room) {
//        if(!$this->meet($room, Room::USER_CONNECTED_CODE)) {
//            return json_encode( array( 'connected' => false ) );
//        }
        $step = $this->getStep($room);
        if($step !== NULL) {
            $maps = $this->getBans($room);
            return json_encode( array( 'connected' => true, 'updates' => true, 'step' => intval($step), 'maps' => $maps) );
        } else {
            return json_encode( array( 'connected' => true, 'updates' => false ) ); // No maps banned.
        }
    }
    
    public function getBans($room) {
        $bansQuery =    
                'SELECT map 
                FROM `ban_list` 
                WHERE `room` = '.$room.';';

        $bansResult = $this->query($bansQuery);
        if($bansResult->num_rows > 0) {
            $maps = array();
            while($row = $bansResult->fetch_array()) {
                $maps[] = self::$mapList[$row[0]];
            }
            $bansResult->close();
            return $maps;
        } else {
            return NULL;
        }
    }
    
    public function checkIn($room, $player) {
        $checkInQuery =
                'INSERT INTO `rooms` (`id`)
                VALUES ("'.($room | $player).'")';
        $this->query($checkInQuery);
        return true; 
    }
    
    public function meet($room, $player) {
        $meetQuery = 
                'SELECT `timestamp` 
                FROM `rooms` 
                WHERE `id` = '.($room | $player).';';

        $stmt = $this->db->prepare($meetQuery);
        $timestamp = 0;
        if($stmt) 
        {
            $stmt->bind_result($timestamp);
            for($i = 0; $i < 60; $i++) { // 60 Second timeout
                $stmt->execute();
                $stmt->fetch();
                if($timestamp) {
                    break;
                }
                usleep(1000000); // 1 Check per second
            }
            $stmt->close();
            if($timestamp) {
                if($player === Room::USER_PLAYER2) {
                    $this->checkIn($room, Room::USER_CONNECTED_CODE);
                }
                return true;
            } else {
                return false;
            }
        } else {
            $this->error($meetQuery);
        }
    }
    
    public function timeout($room) {
        $listenQuery = 
                'SELECT `step` 
                FROM `ban_list` 
                WHERE `room` = '.$room.' 
                ORDER BY `step` DESC 
                LIMIT 1';

        $stmt = $this->db->prepare($listenQuery);
        $step = 0;
        $newStep = 0;
        if(!$stmt) {
            $this->error($listenQuery);
        }
        
        $stmt->bind_result($newStep);
        $time = self::BAN_TIMEOUT;
        while($step < 6) {
            echo 'Step: '.$step.PHP_EOL;
            echo 'NewStep: '.$newStep.PHP_EOL;
            usleep($time);
            $stmt->execute();
            $stmt->fetch();
            if($newStep > $step) {
                $step = $newStep;
                $time = self::BAN_TIMEOUT - 0;//$this->getTimeStamp($room);
                $stmt->free_result();
            } else {
                $step++;
                $time = self::BAN_TIMEOUT;
                $stmt->free_result();
                $this->penalty($room);
            }
        }
        $stmt->close();
    }
    
    public function penalty($room) {
        $bansQuery =    
                'SELECT `map` 
                FROM `ban_list` 
                WHERE `room` = '.$room.';';

        $bansResult = $this->query($bansQuery);
        if($bansResult->num_rows > 0) {
            $maps = array();
            while($row = $bansResult->fetch_array()) {
                $maps[] = $row[0];
            }
            /* NB: $difference is NOT a numeric array */
            $difference = array_diff(range(1, 7), $maps);
            /* mt_rand here generates a key, not an index! */
            $selection = $difference[array_rand($difference)];
            //$selection = $difference[mt_rand(1, count($difference))];
            $bansResult->close();
        } else {
            $selection = mt_rand(1, 7);
        }
        $this->ban($room, 7, $selection);
    }
    
    private function query($query) {
        $result = $this->db->query($query);
        if($result) {
            return $result;
        } else {
            echo "DB query error. #".$this->db->errno.": ".$this->db->error.PHP_EOL;
            echo "Query: ".$query.PHP_EOL;
            exit;
        }
    }
    
    private function error($query) {
        echo "DB query error. #".$this->db->errno.": ".$this->db->error.PHP_EOL;
        echo "Query: ".$query.PHP_EOL;
        exit;
    }
}    
