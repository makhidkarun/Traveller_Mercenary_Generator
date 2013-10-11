<?php

class Being {

    protected $stats = array( 'STR' => 0,
                            'DEX' => 0,
                            'CON' => 0,
                            'INT' => 0,
                            'EDU' => 0,
                            'SOC' => 0 );

    protected $name;

    public function __construct() {
        echo "Name is " . $this->name;
    }        

    protected function roll($num_dice) {
        $total = 0;
        for ( $i = 0; $i <= $num_dice; $i++) {
            $total += rand(1,6);
        }
        return $total;
    }

    protected function roll_stats($stats) {
}



    
