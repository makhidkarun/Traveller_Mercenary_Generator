<?php

require_once 'person_class.php';

class Trooper extends Person {

    public function __construct() {

        $this->age = $this->roll_age(1, 3)  + 20;

    }

//    public function get_name() {
//        return $this->name;
//    }
}

