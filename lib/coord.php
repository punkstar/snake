<?php
class Coord {
    protected $_x;
    protected $_y;
    
    public function __construct($x, $y) {
        $this->_x = $x;
        $this->_y = $y;
    }
    
    public function getX() {
        return $this->_x;
    }
    
    public function getY() {
        return $this->_y;
    }
    
    public function add($x, $y) {
        $this->_x += $x;
        $this->_y += $y;
    }
    
    public function toArray() {
        return array($this->_x, $this->_y);
    }
}