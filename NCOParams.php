<?php

// NCOParams.php
// From MANCHUCK on #phpmentoring

require_once 'RoleAbstract.php';

class NCOParams extends RoleAbstract {

    public function __construct() {

        $this->set_min_age(20);
        $this->set_max_age(30);
        $this->set_min_rank(3);
        $this->set_max_rank(9);
        $this->set_rank_group('enlisted');

    }
   
    protected function set_min_age($num) {
        $this->min_age = $num;
    }
    
    public function get_min_age() {
        return $this->min_age;
    } 

    protected function set_max_age($num) {
        $this->max_age = $num;
    }

    public function get_max_age() {
        return $this->max_age;
    }

    protected function set_min_rank($num) {
        $this->min_rank = $num;
    }

    public function get_min_rank() {
        return $this->min_rank;
    }

    protected function set_max_rank($num) {
        $this->max_rank = $num;
    }

    public function get_max_rank() {
        return $this->max_rank;
    }

    protected function set_rank_group($group){
        $this->rank_group = $group;
    }

    public function get_rank_group() {
        return $this->rank_group;
    }

}

