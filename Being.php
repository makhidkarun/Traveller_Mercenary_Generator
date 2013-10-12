<?php

// Being.php
// To be implemented in various ways.

abstract class Being {

    protected $stats = array();
    
    public $name;
    public $age;
    public $fred;

    protected function set_age($min, $max) {
        return rand($min, $max);
    }

    protected function set_gender($percent_male) {
        $gender = 'female';
        $roll = rand(1,100);
        if ( $roll <= $percent_male ) {
            $gender = 'male';
        }

        return $gender;
    }

    protected function set_name($person_params, $race, $gender) {
        $first_rand = rand(0, $person_params['names'][$race]['count'][$gender]);
        $first_name = $person_params['names'][$race][$gender][$first_rand];

        $last_rand = rand(0, $person_params['names'][$race]['count']['last']);
        $last_name = $person_params['names'][$race]['last'][$last_rand];
   
        $name = $first_name . ' ' . $last_name;
 
        return $name;     
    }
    

}



    
