<?php

require_once 'Being.php';
require_once 'Dice.php';

class Trooper extends Being {

//    private $person_params;

    public function __construct() {
        require_once 'person_params.php';

        $this->age = $this->set_age(17, 20);
        $this->gender = $this->set_gender(50);
        $this->name =  $this->set_name($person_params, 'humaniti', $this->gender);
    }

}

