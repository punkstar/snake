<?php
class Grid {
    protected $_x;
    protected $_y;
    
    public function __construct($x, $y) {
        $this->_x = $x;
        $this->_y = $y;
    }
    
    public function getWidth() {
        return $this->_x;
    }
    
    public function getHeight() {
        return $this->_y;
    }
    
    public function getRandomCoord() {
        return new Coord(rand(0, $this->_x - 1), rand(0, $this->_y - 1));
    }
    
    public function toArray() {
        return array(
            "width"  => $this->getWidth(),
            "height" => $this->getHeight()
        );
    }
}