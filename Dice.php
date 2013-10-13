<?php

// Dice.php
// Helper class with dice and random number conventions.

class Dice {

    public function roll_dice($num_dice, $die_min, $die_max) {
        $total = 0;
        for ( $i = 1; $i <= $num_dice; $i++) {
            $total += mt_rand($die_min , $die_max);
        }
        return $total;
    }

    public function generate_upp() {
        $upp = '';
        for ( $i = 1; $i <= 6; $i++) {
            $stat_roll = $this->roll_dice(2,1,6);
            $stat = strtoupper(dechex($stat_roll));
            $upp = $upp . $stat;
        }
        return $upp;
    }

}



    
