<?php

require_once 'stat_array.php';

// $lastname_db = new PDO('sqlite:/var/www/db/last_names.db');	
class Person {

	public $name;
	public $age;
	public $gender = "Female";
	public $skills = array();
//	public $roles = array();
	public $UPP;

	public function __construct() {
		$this->age = 10 + rand(1,7);
		$this->gender = $this->roll_gender(50);
		return true;
	} 

	protected function roll_age($min, $max) {
		return 17 + rand($min, 2 * $max);
	}

	protected function roll_gender($trigger) {
		if (rand(1, 100) < $trigger) {
			return "Male";
		} else {
			return "Female";
		}
	}

	public function change_role(&$params, $role) {
		$this->add_skill($this->skills, $params['base_skill'][$role]);
		$this->role = $role;
	}

	// Note the array pass by reference, per ##php fluffypony
	protected function add_skill(&$skill_array, $skill) {
		if (array_key_exists($skill, $skill_array)) {
			$skill_array[$skill] = $skill_array[$skill] + 1;
		} else {
			$skill_array[$skill] = 1;
		}
		return $skill_array;
	}
}

class Trooper extends Person {

	protected $rank_min = 1;
	protected $rank_max = 2;
	protected $rank_class = 'rank_enlisted';
	public $rank;
	public $role = 'troop';

	public function __construct($params) {
		parent::__construct($params);
		$this->age = $this->roll_age($this->rank_min, $this->rank_max);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
		$this->add_skill($this->skills,  $params['base_skill'][$this->role]);
		return true;
	}
	
	protected function get_rank($rank_min, $rank_max) {
		return rand($rank_min, $rank_max);
	}
	
}

class Corporal extends Trooper {

	protected $rank_min = 3;
	protected $rank_max = 4;
	public function __construct($params) {
		parent::__construct($params);
	}
}


class NCO extends Trooper {
	protected $rank_min = 4;
	protected $rank_max = 6;
	public $role = 'nco';

	public function __construct($params) {
		parent::__construct($params);
		$this->add_skill($this->skills,  $params['base_skill']['troop']);
	}
}

/*
class SNCO extends NCO {
	private $rank_min = 6;
	private $rank_max = 9;

	public function __construct($params) {
		parent::__construct($params);
	}
}

class Platoon_Officer extends Trooper {
	public $rank_min = 1;
	public $rank_max = 2;
	protected $rank_class = 'rank_officer';

	public function __construct($params) {
		parent::__construct($params);
	}
}

class Company_Officer extends Platoon_Officer {
	private $rank_min = 3;
	private $rank_max = 4;
	public $role = 'officer';

	public function __construct($params) {
		parent::__construct($params);
	}
}
*/
?>
