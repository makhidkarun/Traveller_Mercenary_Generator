<?php

// Being.php
// To be implemented in various ways.

require_once 'person_params.php';
require_once 'Dice.php';

abstract class Being {

    public $stats = array('Str' => 0, 'Dex' => 0, 'End' => 0, 'Int' => 0, 'Edu' => 0, 'Soc' => 0);
    protected $skills = array();
    protected $upp;
    protected $name;
    protected $age;
    protected $gender;
    public $skill_tables = array();

    protected function set_age($min, $max) {
        return mt_rand($min, $max);
    }

    public function get_age() {
        return $this->age;
    }

    protected function set_gender($percent_male) {
        $gender = 'female';
        $roll = mt_rand(1,100);
        if ( $roll <= $percent_male ) {
            $gender = 'male';
        }
        return $gender;
    }
    
    public function get_gender() {
        return $this->gender;
    }

    protected function set_name($race, $gender) {
        global $person_params;

        $first_rand = mt_rand(0, $person_params['names'][$race]['count'][$gender] - 1);
        $first_name = $person_params['names'][$race][$gender][$first_rand];

        $last_rand = mt_rand(0, $person_params['names'][$race]['count']['last'] - 1);
        $last_name = $person_params['names'][$race]['last'][$last_rand];
   
        $name = $first_name . ' ' . $last_name;
 
        return $name;     
    }

    public function get_name() {
        return $this->name;
    }
    
    protected function set_stats(&$stats) {
        foreach($stats as $stat => $value) {
            $die = new Dice();
            $stats[$stat] = $die->roll_dice(2,1,6);
        }
        return $stats; 
    }

    public function get_stat($stats, $stat) {
        return $stats[$stat];
    }

    public function get_stat_hex($stats, $stat) {
        return strtoupper(dechex($stats[$stat]));
    }

    protected function set_upp($stats){
        $upp = '';
        reset ($stats);
        while (list($k, $v) = each($stats)) {
            $upp = $upp . strtoupper(dechex($stats[$k])); 
        }
        return $upp;
    }

    public function get_upp() {
        return $this->upp;
    }
       
    public function raise_stat($stats, $stat_to_raise, $raise_by){
        $stats[$stat_to_raise] += $raise_by;
        return $stats;
    }
 
    public function add_skill(&$skills, $skill) {    
        if (array_key_exists($skill, $skills)) {
            $skills[$skill] += 1;
        } else {
            $skills[$skill] = 1;
        }
        return $skills;
    }

    public function get_skills() {
       return $this->skills;
    }
   
    public function choose_skill ($skill_array, $skill_tables) {
        // There are a lot of modifiers to this stuff.
        $roll = mt_rand(1,6);
        $rand_table = array_rand($skill_tables);
        $skill = $skill_array[$rand_table][$roll];
        return $skill;
    }

    public function add_skill_tables(&$skill_tables, $table) {
        $skill_tables[$table] = 0;
        return $skill_tables;
    } 

    public function get_skill_tables() {
        return $this->skill_tables;
    }

}
