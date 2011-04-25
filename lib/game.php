<?php
class Game {
    protected $_grid;
    protected $_goal;
    protected $_snakes = array();
    
    public function __construct(Grid $g) {
        $this->_grid = $g;
        $this->setRandomGoal();
    }
    
    public function addSnake(Snake $snake) {
        $this->_snakes[] = $snake;
    }
    
    public function step() {
        foreach ($this->_snakes as $snake) {
            if ($snake->getPosition() == $this->_goal) {
                $this->setRandomGoal();
                $snake->grow();
            }
            
            $snake_x = $snake->getPosition()->getX();
            $snake_y = $snake->getPosition()->getY();
            
            $goal_x = $this->_goal->getX();
            $goal_y = $this->_goal->getY();
            
            if        ($snake_x < $goal_x && $this->isFreeCell($snake_x + 1, $snake_y)) {
                $snake->move($snake::$EAST);
            } else if ($snake_x > $goal_x && $this->isFreeCell($snake_x - 1, $snake_y)) {
                $snake->move($snake::$WEST);
            } else if ($snake_y < $goal_y && $this->isFreeCell($snake_x, $snake_y + 1)) {
                $snake->move($snake::$SOUTH);
            } else if ($snake_y > $goal_y && $this->isFreeCell($snake_x, $snake_y - 1)) {
                $snake->move($snake::$NORTH);
            } else {
                $snake->move($snake->getRandomDirection());
            }
        }
    }
    
    public function isFreeCell($x, $y) {
        $array = $this->toArray();
        foreach ($array['snakes'] as $snake) {
            $points = array_merge($snake['head'], $snake['body']);
            
            foreach ($points as $point) {
                if ($point[0] == $x && $point[1] == $y) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    public function getSnakes() {
        return $this->_snakes;
    }
    
    public function setRandomGoal() {
        $this->_goal = $this->_grid->getRandomCoord();
    }
    
    public function toArray() {
        $result = array(
            "grid"   => $this->_grid->toArray(),
            "goal"   => $this->_goal->toArray(),
            "snakes" => array_map(function ($snake) {
                return $snake->toArray();
            }, $this->getSnakes())
        );
        
        foreach ($result['snakes'] as &$snake) {
            $snake['head'][0] %= $this->_grid->getWidth();
            $snake['head'][1] %= $this->_grid->getHeight();
            
            $snake['head'][0] += $this->_grid->getWidth();
            $snake['head'][1] += $this->_grid->getHeight();
            
            $snake['head'][0] %= $this->_grid->getWidth();
            $snake['head'][1] %= $this->_grid->getHeight();
            
            foreach ($snake['body'] as &$body) {
                $body[0] %= $this->_grid->getWidth();
                $body[1] %= $this->_grid->getHeight();
                
                $body[0] += $this->_grid->getWidth();
                $body[1] += $this->_grid->getHeight();
                
                $body[0] %= $this->_grid->getWidth();
                $body[1] %= $this->_grid->getHeight();
            }
        }
        
        return $result;
    }
}