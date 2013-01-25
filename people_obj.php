<?php

require_once 'stat_array.php';

class Person {

	public	$name;
	public	$age;
	public $gender = "Female";
	public $skills = array();
	public $roles = array();
	
	public function __construct() {
		$this->age = 10 + rand(1,7);
		$this->gender = $this->roll_gender(50);
		return true;
	} 

	protected function roll_age($min, $max) {
		return 17 + rand($min, $max);
	}

	protected function roll_gender($trigger) {
		if (rand(1, 100) < $trigger) {
			return "Male";
		} else {
			return "Female";
		}
	}

	protected function add_skill(&$skill_array, $skill) {
	// Note the array pass by refernece, per ##php fluffypony
		if (array_key_exists($skill, $skill_array)) {
			$skill_array[$skill] = $skill_array[$skill] + 1;
		} else {
			$skill_array[$skill] = 1;
		}
		return $skill_array;
	}
}

class Trooper extends Person {

	private $rank_min = 1;
	private $rank_max = 2;
	protected $rank_class = 'rank_enlisted';
	public $rank;
	public function __construct($params) {
		$this->roles[] = 'troop';
		$this->age = $this->roll_age($this->rank_min, 3 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
		foreach($this->roles as $role) {
			  $this->add_skill($this->skills,  $params['base_skill'][$role]);
		}

		
		return true;
	}
	
	protected function get_rank($rank_min, $rank_max) {
		return rand($rank_min, $rank_max);
	}
		
}

class Corporal extends Trooper {
	private $rank_min = 3;
	private $rank_max = 4;

	public function __construct($params) {
		$this->age = $this->roll_age($this->rank_min , 5 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}

class NCO extends Corporal {
	private $rank_min = 4;
	private $rank_max = 6;

	public function __construct($params) {
		$this->age = $this->roll_age($this->rank_min , 7 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}

class SNCO extends NCO {
	private $rank_min = 6;
	private $rank_max = 9;

	public function __construct($params) {
		$this->age = $this->roll_age($this->rank_min , 10 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}

class Platoon_Officer extends Trooper {
	private $rank_min = 1;
	private $rank_max = 2;
	protected $rank_class = 'rank_officer';

	public function __construct($params) {
		$this->age = $this->roll_age($this->rank_min , 4 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}


class Company_Officer extends Platoon_Officer {
	private $rank_min = 3;
	private $rank_max = 4;

	public function __construct($params) {
		$this->age = $this->roll_age($this->rank_min , 7 + $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}


?>
