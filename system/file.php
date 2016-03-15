<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Template for future PHP communication
 *
 * @author rober
 */
class file {
    const CONNECTION_FILE = 0;
    private $handle;
    
    public function __construct($file) {
        $this->handle = fopen($file, $mode);
    }
    
    public function __destruct() {
        fclose($this->handle);
    }
    
    public function read() {
        return fread($this->handle);
    }
}
