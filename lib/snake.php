<?php
class Snake {
    public static $NORTH = 2;
    public static $EAST  = 3;
    public static $SOUTH = 4;
    public static $WEST  = 5;
    
    protected $_length = 1;
    protected $_trail = null;
    protected $_head;
    
    public function __construct($length) {
        $this->_setLength($length);
        $this->_head = new Coord(0, 0);
    }
    
    protected function _setLength($length) {
        $this->_length = $length;
        
        if ($this->_trail == null) {
            $this->_trail = new Queue($length);
        } else {
            $this->_trail->setSize($length);
        }
    }
    
    public function getPosition() {
        return $this->_head;
    }
    
    public function grow() {
        $this->_setLength($this->_length + 1);
    }
    
    public function moveSouth() {
        $this->_trail->add(clone $this->_head);
        $this->_head->add(0, 1);
    }
    
    public function moveNorth() {
        $this->_trail->add(clone $this->_head);
        $this->_head->add(0, -1);
    }
    
    public function moveEast() {
        $this->_trail->add(clone $this->_head);
        $this->_head->add(1, 0);
    }
    
    public function moveWest() {
        $this->_trail->add(clone $this->_head);
        $this->_head->add(-1, 0);
    }
    
    public function move($direction) {
        switch ($direction) {
            case self::$NORTH:
                $this->moveNorth();
                break;
            case self::$EAST:
                $this->moveEast();
                break;
            case self::$SOUTH:
                $this->moveSouth();
                break;
            case self::$WEST:
                $this->moveWest();
                break;
            default:
                trigger_error("I've no idea which direction you want me to travel in!");
        }
    }
    
    public function getRandomDirection() {
        return rand(self::$NORTH, self::$WEST);
    }
    
    public function clockwiseMoveDirection($direction) {
        return (((($direction - 2) + 1) % 4) + 2);
    }
    
    public function getOccupiedCells() {
        
    }
    
    public function toArray() {
        $trail_array = array();
        
        return array(
            "head" => $this->_head->toArray(),
            "body" => array_map(function ($el) {
                return $el->toArray();
            }, $this->_trail->toArray())
        );
    }
}