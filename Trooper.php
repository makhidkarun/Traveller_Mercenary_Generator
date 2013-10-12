<?php

//require_once 'person_class.php';
require_once 'Being.php';
require_once 'Dice.php';

class Trooper extends Being {

    

    public function __construct() {

        $this->age = $this->set_age(17, 20);

    }

//    public function get_age(){
//        return $this->age;
//    }
//    public function get_name() {
//        return $this->name;
//    }
}

