<?php

require_once 'stat_array.php';

class Person {

	public	$name;
	public	$age;
	public $gender = "Female";
	public $skills = array();
	public $roles = array();

	$lastname_db = new PDO("sqlite:/var/www/db/last_names.db");	
	public function __construct() {
		$this->age = 10 + rand(1,7);
		$this->gender = $this->roll_gender(50);
		return true;
	} 

	protected function roll_age($min, $max) {
		return 17 + rand($min, $max);
	}

	protected function roll_ranked_age($min, $max) {
		$age = 17 + rand($min, 1.5 * $max);
		return intval($age);
	}

	protected function roll_gender($trigger) {
		if (rand(1, 100) < $trigger) {
			return "Male";
		} else {
			return "Female";
		}
	}

	protected function add_skill(&$skill_array, $skill) {
	// Note the array pass by reference, per ##php fluffypony
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
	private $role = 'troop';

	public function __construct($params) {
		parent::__construct($params);
		$this->roles[] = $this->role;
		$this->age = $this->roll_ranked_age($this->rank_min, $this->rank_max);
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

class NCO extends Corporal {
	protected $rank_min = 4;
	protected $rank_max = 6;
	private $role = 'nco';

	public function __construct($params) {
		parent::__construct($params);
		$this->age = $this->roll_ranked_age($this->rank_min, $this->rank_max);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
		$this->roles[] = $this->role;
		$this->add_skill($this->skills,  $params['base_skill'][$this->role]);
	}
}
/*
class SNCO extends NCO {
	private $rank_min = 6;
	private $rank_max = 9;

	public function __construct($params) {
		$this->age = $this->roll_ranked_age($this->rank_min , $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}
*/
class Platoon_Officer extends Trooper {
	public $rank_min = 1;
	public $rank_max = 2;
	protected $rank_class = 'rank_officer';

	public function __construct($params) {
		$this->age = $this->roll_ranked_age($this->rank_min , $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}

/*
class Company_Officer extends Platoon_Officer {
	private $rank_min = 3;
	private $rank_max = 4;

	public function __construct($params) {
		$this->age = $this->roll_ranked_age($this->rank_min , $this->rank_max);
		$this->gender = $this->roll_gender($params['percent_male']);
		$this->rank = $params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
	}
}
*/

?>
