<?php

require_once 'person_class.php';
require_once 'trooper_params.php';

class Trooper extends Person {

	protected $rank_min = 1;
	protected $rank_max = 2;
	protected $rank_class = 'rank_enlisted';
	public $rank;
	public $role = 'troop';

	public function __construct($trooper_params, $person_params) {
		parent::__construct($person_params);
		$this->UPP = $this->generate_stats($person_params);
		$this->age = $this->roll_age($this->rank_min, $this->rank_max);
		$this->rank = $trooper_params[$this->rank_class][$this->get_rank($this->rank_min, $this->rank_max)];
		$this->add_skill($this->skills,  $trooper_params['base_skill'][$this->role]);
		for ( $i = 0; $i <= $this->rank_max; $i++) {
			$rand = rand($this->rank_min, $this->rank_max * 3);
			if ( $this->rank_min > 4 ) {
				$rand += 5;
			}
			if ( substr($this->upp, 4, 0)  > 7 ) {
				$rand += 5;
			}
			if ($this->rank_class == 'rank_officer') {
				$rand += 5;
			}
			if ( $rand > 30 ) {
				$rand = rand(20, 30);
			}
			$this->add_skill($this->skills, $trooper_params['all_skills'][$rand]);
		}
		return true;
	}
	
	protected function get_rank($rank_min, $rank_max) {
		return rand($rank_min, $rank_max);
	}
	
}

class Corporal extends Trooper {

	protected $rank_min = 3;
	protected $rank_max = 4;
	public function __construct($trooper_params, $person_params) {
		parent::__construct($trooper_params, $person_params);
	}
}


class NCO extends Trooper {
	protected $rank_min = 4;
	protected $rank_max = 6;
	public $role = 'nco';

	public function __construct($trooper_params, $person_params) {
		parent::__construct($trooper_params, $person_params);
		$this->add_skill($this->skills,  $trooper_params['base_skill']['troop']);
	}
}

class SNCO extends NCO {
	protected $rank_min = 6;
	protected $rank_max = 9;

	public function __construct($trooper_params, $person_params) {
		parent::__construct($trooper_params, $person_params);
	}
}

class Platoon_Officer extends Trooper {
	protected $rank_min = 1;
	protected $rank_max = 2;
	protected $rank_class = 'rank_officer';

	public function __construct($trooper_params, $person_params) {
		parent::__construct($trooper_params, $person_params);
	}
}

class Company_Officer extends Platoon_Officer {
	protected $rank_min = 3;
	protected $rank_max = 4;
	public $role = 'company_officer';

	public function __construct($trooper_params, $person_params) {
		parent::__construct($trooper_params, $person_params);
	}
}

/*
function generate_squad($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $unit_number, $rank_structure, $base_skills, $all_skills) {
	
	$UNIT = $unit_id[$unit_number];
	echo "\n$UNIT Squad:\n";
	
	if ($UNIT == '1st') {
		generate_person( 6, 7, 'nco', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
		generate_person( 2, 3, 'medic', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	} else {
		generate_person( 5, 6, 'nco', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	}
	
	for ( $i = 0; $i < $troop_count['troops_per_squad']; $i++) {
		if ( $i == 0) {
			echo "\n";
			generate_person( 3, 4, 'nco', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
		} elseif (( $i % 4) == 0) {
			echo "\n";
			generate_person( 2, 3, 'troop', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
		} else {
			generate_person( 1, 1, 'troop', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
		}
	}
}

function generate_platoon($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $unit_number, $rank_structure, $rank_structure, $base_skills, $all_skills) {

	$UNIT = $unit_id[$unit_number];
	echo "\n$UNIT Platoon: \n";
	
	if ( $UNIT == '1st') {	
		generate_person( 11, 11, 'officer', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	} else {
		generate_person( 10, 11, 'officer', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	}
		
	for ( $i = 1; $i <= $troop_count['squads_per_platoon']; $i++) {	
		generate_squad($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $i , $rank_structure, $base_skills, $all_skills);
	}
}

function generate_company($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $hq_staff_roles, $rank_structure, $rank_structure, $base_skills, $all_skills) {
	echo "Commander: \n";
	generate_person( 12, 13, 'officer', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	
	generate_hq_staff($hq_staff_roles, $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills);

	for ( $i = 1; $i <= $troop_count['platoons_per_company']; $i++ ) {
		generate_platoon($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $i, $rank_structure, $rank_structure, $base_skills, $all_skills);
	}
}

function generate_hq_staff($hq_staff_roles, $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) {
	echo "HQ Platoon:\n";
	generate_person( 7, 9, 'nco', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 4, 6, 'medic', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'comm', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'sensors', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'clerk', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 1, 2, 'driver', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 1, 2, 'driver', $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) ;
}
/*
function open_web_page($troop_count, $stat_parameters, $_POST) {

	if (array_key_exists('_submit_check', $_POST)) {
		if (is_numeric($_POST['troops_per_squad'])) {
			$troop_count['troops_per_squad'] = $_POST['troops_per_squad'];
		}
		if (is_numeric($_POST['squads_per_platoon'])) {
			$troop_count['squads_per_platoon'] = $_POST['squads_per_platoon'];
		}
		if (is_numeric($_POST['platoons_per_company'])) {
			$troop_count['platoons_per_company'] = $_POST['platoons_per_company'];
		}
		if (is_numeric($_POST['min_stat'])) {
			$stat_parameters['min_stat'] = $_POST['min_stat'];
		}
		if (is_numeric($_POST['min_physical_stat'])) {
			$stat_parameters['min_physical_stat'] = $_POST['min_physical_stat'];
		}
		if (is_numeric($_POST['min_mental_stat'])) {
			$stat_parameters['min_mental_stat'] = $_POST['min_mental_stat'];
		}
		if (is_numeric($_POST['max_stat'])) {
			$stat_parameters['max_stat'] = $_POST['max_stat'];
		}
	}

	$min_stat = $stat_parameters['min_stat'];
	
	print<<<_HTML_
	<html>
	<head>
		<title>LH Traveller Mercenary Generator</title>
	</head>
	<body>
	<h2>Traveller Mercenary Generator</h2>
	<p>Adjust defaults if you want and then hit "Sign them up!"

	<form method="POST" action="$_SERVER[PHP_SELF]">
	<table cellpadding="20" width="90%">
	<tr><td align="top">
	<h3>Individual Stat Parameters</h3>
	<p>Minimum Stat (2-15)
		<input type="number" min="2" max="15" name="min_stat" value="$min_stat" size="5">
	<p>Minimum Physical Stat (2-15)
		<input type="number" min="2" max="15" name="min_physical_stat" value="$stat_parameters['min_physical_stat']" size="5">
	<p>Minimum Mental Stat (2-15)	
		<input type="number" min="2" max="15"name="min_mental_stat" value="$stat_parameters['min_mental_stat']" size="5">
	<p>Maximum Stat (2-15)
		<input type="number" min="2" max="15" name="max_stat" value="$stat_parameters['max_stat']" size="5">
	</td>
	<td align="top">
	<h3>TOE Parameters</h3>

	<p>Troops per Squad (1-15)
		<input type="number" min="1" max="15" name="troops_per_squad" value="$troop_count['troops_per_squad']" size ="5">
	<p>Squads Per Platoon (1-8 )
		<input type="number" min="1" max="8" name="squads_per_platoon" value="$troop_count['squads_per_platoon']" size ="5">
	<p>Platoons per Company (1-8)
		<input type="number" min="1" max="8" name="platoons_per_company" value="$troop_count['platoons_per_company']" size ="5">

	<br>
	<input type="hidden" name="_submit_check" value="1">
	<input type="submit" value="Sign them up!" name="submit">

	</td></tr>
	</table>
	</form>

	<hr>
	<pre>
	
_HTML_;
		
}

*/

?>

