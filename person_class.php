<?php

require_once 'person_params.php';

// $lastname_db = new PDO('sqlite:/var/www/db/last_names.db');	
class Person {

	public $name;
	public $age;
	public $culture = 'humaniti';
	public $gender = "Female";
	public $skills = array();
	public $upp;

	public function __construct($person_params) {
		$this->age = 10 + rand(1,7);
		$this->gender = $this->roll_gender($person_params['stats']['percent_male']);
		$this->upp = $this->generate_stats($person_params);
		$this->name = $this->set_name($this->culture, strtolower($this->gender), $person_params);
		return true;
	} 

	protected function set_name($culture, $gender, $person_params) {
		$last_name = $this->get_last_name($culture, $person_params);
		$first_name = $this->get_first_name($culture, $gender, $person_params);
		$this->name = $first_name . " " . $last_name;
		return $this->name;
	}
	
	protected function get_last_name($culture, $person_params) {
		$max_count = $person_params['names'][$culture]['count']['last'];
		$i = rand(0, $max_count - 1);
		return $person_params['names'][$culture]['last'][$i];
	}

	protected function get_first_name($culture, $gender, $person_params) {
		$max_count = $person_params['names'][$culture]['count'][$gender];
		$i = rand(0, $max_count - 1);
		return $person_params['names'][$culture][$gender][$i];	
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


	function generate_stats($params) {
		$UPP = "";
		for ( $i = 0; $i < 3; $i++) {
			$stat_roll = rand(1,6) + rand(1,6);
			if ($stat_roll < $params['stats']['min_phy_stat'] ) {
				$stat_roll = $params['stats']['min_phy_stat'];
			} else if ( $stat_roll > $params['stats']['max_stat']) {
				$stat_roll = $params['stats']['max_stat'];
			}
			$UPP = $UPP . strtoupper(dechex($stat_roll));
		}
		for ( $i = 0; $i < 2; $i++ ) {
			$stat_roll = rand(1,6) + rand(1,6);
			if ($stat_roll < $params['stats']['min_men_stat'] ) {
				$stat_roll = $params['stats']['min_men_stat'];
			} else if ( $stat_roll > $params['stats']['max_stat']) {
				$stat_roll = $params['stats']['max_stat'];
			}
			$UPP = $UPP . strtoupper(dechex($stat_roll));
		}
		$stat_roll = rand(1,6) + rand(1,6);
		if ($stat_roll < $params['stats']['min_stat'] ) {
			$stat_roll = $params['stats']['min_stat'];
		} else if ( $stat_roll > $params['stats']['max_stat']) {
			$stat_roll = $params['stats']['max_stat'];
		}
		$UPP = $UPP . strtoupper(dechex($stat_roll));
		
		return $UPP;
	}
}

?>
