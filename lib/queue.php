<?php
class Queue {
    protected $_size = 0;
    protected $_items = array();
    
    public function __construct($size) {
        $this->setSize($size);
    }
    
    public function setSize($size) {
        $this->_size = $size;
    }
    
    public function add($item) {
        array_push($this->_items, $item);
        
        if (count($this->_items) > $this->_size) {
            array_shift($this->_items);
        }
    }
    
    public function toArray() {
        return array_reverse($this->_items);
    }
}