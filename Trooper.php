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
require_once 'person_params.php';

class Trooper extends Being {

    private $rank, $mos;
    private $min_age, $max_age, $min_rank, $max_rank, $rank_group, $rank_roll;

    public function __construct(MilitaryRoleAbstract $role) {
        global $mercenary_skills, $person_params; 

        $this->gender = $this->setGender(50);
        $this->name =  $this->setName($person_params, 'humaniti', $this->gender);
        $this->stats = $this->setStats($this->stats);
        $this->upp = $this->setUpp($this->stats);
        $rank_roll = mt_rand($role->get_min_rank(), $role->get_max_rank());
        $this->age = $this->setAge($role->get_min_age(), $role->get_max_age()) + $rank_roll;
        $this->rank = $this->setRank($role->get_rank_group(), $rank_roll);

        // Set the MOS and list of skill tables to choose from
        $this->mos = $this->setMos();       
        $this->skill_tables = $this->addSkillTables(&$this->skill_tables, 'ArmyLife');
        $mos_table = 'MOS_' . $this->mos;
        $this->skill_tables = $this->addSkillTables(&$this->skill_tables, $mos_table);
        if ( count($role->additional_skill_tables) > 0  ) {
            foreach ( $role->additional_skill_tables as $key => $value) {
               $this->skill_tables = $this->addSkillTables(&$this->skill_tables, $value);
            }
        }

        // Start adding skills 
        $this->skills = $this->addSkill($this->skills, 'GunCbt');
        $num_skills = $rank_roll / 2;
        for ( $i = 0; $i <= $num_skills; $i++ ) {
            $new_skill = $this->chooseSkill($mercenary_skills, $this->skill_tables);
            if ( $new_skill[0] == '+' ) {
                $stat_to_increase = $new_skill[3] . $new_skill[4] . $new_skill[5];
                $this->raiseStat(&$this->stats, $stat_to_increase, 1);
            } else {
                $this->skills = $this->addSkill($this->skills, $new_skill);
            }
        }

        
        // Final UPP after stats potentially altered. 
        $this->upp = $this->setUpp($this->stats);
    }

    protected function setRank($rank_group, $rank_roll) 
    {
        // This global will go away when I have a db for it.
        global $ranks;
        return $ranks[$rank_group][$rank_roll];
    }
       
    public function getRank() 
    {
        return $this->rank;
    }

    protected function setMos() 
    {
        $mos_list = array('Infantry', 'Cavalry');
        $mos_roll = mt_rand(0,1);
        $mos = $mos_list[$mos_roll];
        return $mos;
    }
    
    public function getMos() 
    {
        return $this->mos;
    }
 
}

