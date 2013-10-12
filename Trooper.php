<?php

require_once 'Being.php';
require_once 'Dice.php';
require_once 'ranks.php';
require_once 'person_params.php';

class Trooper extends Being {

    public $rank;
    private $min_age, $max_age, $min_rank, $max_rank, $rank_group, $rank_roll;

    public function __construct($role) {
       global $person_params; 

        switch($role) {
            case 'trooper':
                $min_age = 16;
                $max_age = 18;
                $min_rank = 1;
                $max_rank = 2;
                $rank_group = 'enlisted';
                $skill_groups = array('MOS' => 0, 'Life');
                break;
            case 'nco':
                $min_age = 20;
                $max_age = 30;
                $min_rank = 3;
                $max_rank = 9;
                $rank_group = 'enlisted';
                $skill_groups = array('MOS' => 0, 'Life', 'NCO');
                break;
        }

        $rank_roll = rand($min_rank, $max_rank);
        $this->gender = $this->set_gender(50);
        $this->name =  $this->set_name('humaniti', $this->gender);
        $this->rank = $this->set_rank($rank_group, $rank_roll);
        $this->age = $this->set_age($min_age, $max_age) + $rank_roll;
        $this->stats = $this->set_stats($this->stats);
        $this->upp = $this->set_upp($this->stats);
    }

    protected function set_rank($rank_group, $rank_roll) {
        global $ranks;
        return $ranks[$rank_group][$rank_roll];
    }
        
}

