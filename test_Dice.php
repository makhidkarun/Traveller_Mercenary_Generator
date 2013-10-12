<?php

// test_Dice.php

require_once 'Dice.php';

class test_Dice extends Dice {


    public function __construct() {
        $my_upp = $this->generate_upp();
        echo "My UPP: " . $my_upp . "\n";
    }
}

$my_test = new test_Dice();

?>

