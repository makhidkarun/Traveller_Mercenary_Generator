<?php

/*
	Include File of functions for create_mercenary_unit.php
	version 0.1
*/

require_once 'male_first_names.php';
require_once 'female_first_names.php';

if (! isset($troop_counttroops_per_squad)) {
	$troop_count = array (
		'troops_per_squad' => 8,
		'squads_per_platoon' => 3,
		'platoons_per_company' => 4);
}

if (! isset($stat_parameters)) {
	$stat_parameters = array (
		'min_stat' => 2,
		'min_physical_stat' => 6,
		'min_mental_stat' => 5,
		'max_stat' => 10);
}

$hq_staff_roles = array (
	0 => '1st Sgt',
	1 => 'Fwd Obs',
	2 => 'Comms ', 
	3 => 'Sensors',
	4 => 'Medic ',
	5 => 'Driver',
	6 => 'Driver',
	7 => 'Clerk ');

$unit_id = array(
	1 => '1st',
	2 => '2nd',
	3 => '3rd',
	4 => '4th',
	5 => '5th',
	6 => '6th',
	7 => '7th',
	8 => '8th'

);

$rank_structure = array (
	1 => 'PVT',
	2 => 'PV2',
	3 => 'PFC',
	4 => 'CPL',
	5 => 'SGT',
	6 => 'SSG',
	7 => 'SFC',
	8 => 'MSG',
	9 => 'SGM',
	10 => '2LT',
	11 => '1LT',
	12 => 'CPT',
	13 => 'MAJ',
	14 => 'LTC',
	15 => 'COL',
	16 => 'BG');

$base_skills = array (
	'troop' => 'GunCbt',
	'medic' => 'Medic',
	'nco' => 'Leadership',
	'officer' => 'Leadership',
	'driver' => 'Drive',
	'clerk' => 'Admin',
	'comm' => 'Commo',
	'sensors' => 'Sensors');

$all_skills = array (
	1 => 'GunCbt',
	2 => 'Drive',
	3 => 'Athlete',
	4 => 'Melee',
	5 => 'HvyWpn',
	6 => 'GunCbt',
	7 => 'Melee',
	8 => 'HvyWpn',
	9 => 'Stealth',
	10 => 'Medic',
	11 => 'Recon',
	12 => 'GunCbt',
	13 => 'Mechanic',
	14 => 'Drive',
	15 => 'Gunnery',
	16 => 'Recon',
	17 => 'Sensors',
	18 => 'Admin',
	19 => 'Commo',
	20 => 'Sensors',
	21 => 'Navigation',
	22 => 'Explosives',
	23 => 'Survival',
	24 => 'Engineer',
	25 => 'Tactics',
	26 => 'Leadership',
	27 => 'Advocate',
	28 => 'Diplomat',
	29 => 'Tactics',
	30 => 'Admin');

/*
 Functions 
*/

function get_last_name($last_names) {
	$i = rand(0, count($last_names));
	return $last_names[$i];
}

function get_first_name($first_names) {
	$i = rand(0, count($first_names));
	return $first_names[$i];	
}

function generate_stats($stat_parameters) {
	$UPP = "";
	for ( $i = 0; $i < 3; $i++) {
		$stat_roll = rand(1,6) + rand(1,6);
		if ($stat_roll < $stat_parameters['min_physical_stat'] ) {
			$stat_roll = $stat_parameters['min_physical_stat'];
		} else if ( $stat_roll > $stat_parameters['max_stat']) {
			$stat_roll = $stat_parameters['max_stat'];
		}
		$UPP = $UPP . strtoupper(dechex($stat_roll));
	}
	for ( $i = 0; $i < 2; $i++ ) {
		$stat_roll = rand(1,6) + rand(1,6);
		if ($stat_roll < $stat_parameters['min_mental_stat'] ) {
			$stat_roll = $stat_parameters['min_mental_stat'];
		} else if ( $stat_roll > $stat_parameters['max_stat']) {
			$stat_roll = $stat_parameters['max_stat'];
		}
		$UPP = $UPP . strtoupper(dechex($stat_roll));
	}
	$stat_roll = rand(1,6) + rand(1,6);
	if ($stat_roll < $stat_parameters['min_stat'] ) {
		$stat_roll = $stat_parameters['min_stat'];
	} else if ( $stat_roll > $stat_parameters['max_stat']) {
		$stat_roll = $stat_parameters['max_stat'];
	}
	$UPP = $UPP . strtoupper(dechex($stat_roll));
	
	return $UPP;
}

function add_skill($skill_array, $skill) {
	if (array_key_exists($skill, $skill_array)) {
		$skill_array[$skill] = $skill_array[$skill] + 1;
	} else {
		$skill_array[$skill] = 1;
	}
	return $skill_array;
}

function generate_person( $rank_min, $rank_max, $role, $stat_parameters, $last_names, $male_first_names, $female_first_names, $rank_structure, $base_skills, $all_skills) {
	$upp = generate_stats($stat_parameters);
	$rank = $rank_structure[rand($rank_min, $rank_max)];
	$age = 18 + rand(0,5) + $rank_min; 
	if ( rand(1,6) <=5 ) {
		$gender = 'Male';
		$first_name = get_first_name($male_first_names);
	} else {
		$gender = 'Female';
		$first_name = get_first_name($female_first_names);
	}
	
	$last_name = get_last_name($last_names);
	$skill_array = array();
	$skill_count = rand(1,6) + $rank_max/2;
	$max_skill_level = 12 + ($rank_max * 2);
	if ( $rank_max > 8 ) {
		$max_skill_level = count($all_skills);
	} else {
		$max_skill_level = 12 + ($rank_max * 2);
	}	
	$skill_array[$base_skills[$role]] = 1;	
	if ($role != 'officer' && $role != 'troop' ) {
		$skill_array = add_skill($skill_array, 'GunCbt') ;
		$skill_array = add_skill($skill_array, 'Recon') ;
	}
	if ( $rank_min >= 4 ) {
		$skill_array = add_skill($skill_array, 'Leadership') ;
	}
	for ( $i = 0; $i < $skill_count; $i++ ) {
		$skill_array = add_skill($skill_array, $all_skills[rand(1, $max_skill_level)]);
	}	
	echo "\t";
	echo "$rank $first_name $last_name, $upp $gender $age  ";
	echo "\n\t";
	foreach ($skill_array as $skill => $level) {
		echo "$skill - $level ";
	}
	echo "\n";
}
	
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

function close_web_page() {
	echo "</pre></body></html>";
}


?>

