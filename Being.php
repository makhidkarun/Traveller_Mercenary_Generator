<?php

// Being.php
// To be implemented in various ways.

require_once 'person_params.php';
require_once 'Dice.php';

abstract class Being {

    public $stats = array('Str' => 0, 'Dex' => 0, 'End' => 0, 'Int' => 0, 'Edu' => 0, 'Soc' => 0);
    public $skills = array();
    public $upp;
    public $name;
    public $age;

    protected function set_age($min, $max) {
        return mt_rand($min, $max);
    }

    protected function set_gender($percent_male) {
        $gender = 'female';
        $roll = mt_rand(1,100);
        if ( $roll <= $percent_male ) {
            $gender = 'male';
        }

        return $gender;
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
    
    protected function set_stats(&$stats) {
        foreach($stats as $stat => $value) {
            $die = new Dice();
            $stats[$stat] = $die->roll_dice(2,1,6);
        }
        return $stats; 
    }

    protected function set_upp($stats){
        $upp = '';
        $upp = $upp . strtoupper(dechex($stats['Str'])); 
        $upp = $upp . strtoupper(dechex($stats['Dex'])); 
        $upp = $upp . strtoupper(dechex($stats['End'])); 
        $upp = $upp . strtoupper(dechex($stats['Int'])); 
        $upp = $upp . strtoupper(dechex($stats['Edu'])); 
        $upp = $upp . strtoupper(dechex($stats['Soc'])); 
        return $upp;
    }


            
}



    
