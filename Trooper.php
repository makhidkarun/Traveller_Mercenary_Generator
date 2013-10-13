<?php

// Trooper.php
// With mods from MANCHUCK on #phpmentoring

// Notes:
//  https://gist.github.com/manchuck/6952598
//  http://pastebin.com/3DQuBf1q

require_once 'Being.php';
require_once 'imperial_ranks.php';
require_once 'MilitaryRoleAbstract.php';
require_once 'TrooperParams.php';
require_once 'NCOParams.php';
require_once 'mercenary_skills.php';


class Trooper extends Being {

    private $rank, $mos;
    private $min_age, $max_age, $min_rank, $max_rank, $rank_group, $rank_roll;

    public function __construct(MilitaryRoleAbstract $role) {
        global $mercenary_skills; 

        $this->gender = $this->set_gender(50);
        $this->name =  $this->set_name('humaniti', $this->gender);
        $this->stats = $this->set_stats($this->stats);
        $this->upp = $this->set_upp($this->stats);
        $rank_roll = mt_rand($role->get_min_rank(), $role->get_max_rank());
        $this->age = $this->set_age($role->get_min_age(), $role->get_max_age()) + $rank_roll;
        $this->rank = $this->set_rank($role->get_rank_group(), $rank_roll);

        // Set the MOS and list of skill tables to choose from
        $this->mos = $this->set_mos();       
        $this->skill_tables = $this->add_skill_tables(&$this->skill_tables, 'ArmyLife');
        $mos_table = 'MOS_' . $this->mos;
        $this->skill_tables = $this->add_skill_tables(&$this->skill_tables, $mos_table);
        if ( count($role->additional_skill_tables) > 0  ) {
            foreach ( $role->additional_skill_tables as $key => $value) {
               $this->skill_tables = $this->add_skill_tables(&$this->skill_tables, $value);
            }
        }

        // Start adding skills 
        $this->skills = $this->add_skill($this->skills, 'GunCbt');
        $num_skills = $rank_roll / 2;
        for ( $i = 0; $i <= $num_skills; $i++ ) {
            $new_skill = $this->choose_skill($mercenary_skills, $this->skill_tables);
            $this->skills = $this->add_skill($this->skills, $new_skill);
        }

        
 
    }

    protected function set_rank($rank_group, $rank_roll) {
        // This global will go away when I have a db for it.
        global $ranks;
        return $ranks[$rank_group][$rank_roll];
    }
       
    public function get_rank() {
        return $this->rank;
    }

    protected function set_mos() {
        $mos_list = array('Infantry', 'Cavalry');
        $mos_roll = mt_rand(0,1);
        $mos = $mos_list[$mos_roll];
        return $mos;
    }
    
    public function get_mos() {
        return $this->mos;
    }
 
}

