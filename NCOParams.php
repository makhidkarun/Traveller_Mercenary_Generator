<?php

/**
 * NCOParams.php
 * 
 * To be implemented in various ways.
 *
 * PHP Version 5
 * 
 * License: This is open source code of some license I don't yet know.
 * 
 * @category    Games
 * @package     Makhidkarun
 * @author      Leam Hall <leamhall@gmail.com>
 * @copyright   2012-2013 Leam Hall
 * @license     license 1 <http://LICENSEURL.example.com>
 * @version     GIT: 0.2
 * @link        github.com/makhidkarun/Traveller_Mercenary_Generator/blob/master/NCOParams.php
 * @see         huh?
 * @since       Original copyright date
 * @assisting   MANCHUCK
 * 
*/

require_once 'MilitaryRoleAbstract.php';

class NCOParams extends MilitaryRoleAbstract
{

    public $additional_skill_tables;

    public function __construct()
    {

        $this->setMinAge(20);
        $this->setMaxAge(30);
        $this->setMinRank(3);
        $this->setMaxRank(9);
        $this->setRankGroup('enlisted');
        $this->additional_skill_tables = array('NCO');

    }
   
    protected function setMinAge($num)
    {
        $this->min_age = $num;
    }
    
    public function getMinAge()
    {
        return $this->min_age;
    }

    protected function setMaxAge($num)
    {
        $this->max_age = $num;
    }

    public function getMaxAge()
    {
        return $this->max_age;
    }

    protected function setMinRank($num)
    {
        $this->min_rank = $num;
    }

    public function getMinRank()
    {
        return $this->min_rank;
    }

    protected function setMaxRank($num)
    {
        $this->max_rank = $num;
    }

    public function getMaxRank()
    {
        return $this->max_rank;
    }

    protected function setRankGroup($group)
    {
        $this->rank_group = $group;
    }

    public function getRankGroup()
    {
        return $this->rank_group;
    }
}
