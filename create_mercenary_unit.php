<?php

/* 
	Creates a Mercenary company for the Traveller RPG.
	version:	0.1
*/


require_once 'create_mercenary_unit_include.php';
require_once 'names.php';

function get_name($names) {
	$i = rand(0, count($names));
	return $names[$i];
}

function generate_stats($stat_parameters) {
	$UPP = "";
	for ( $i = 0; $i < 3; $i++) {
		$UPP = $UPP . strtoupper(dechex(rand($stat_parameters['MIN_PHY_STAT'], $stat_parameters['MAX_STAT'])));
		}
	for ( $i = 0; $i < 2; $i++ ) {
		$UPP = $UPP . strtoupper(dechex(rand($stat_parameters['MIN_MENTAL_STAT'], $stat_parameters['MAX_STAT'])));
		}
	$UPP = $UPP . strtoupper(dechex(rand($stat_parameters['MIN_STAT'], $stat_parameters['MAX_STAT'])));
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

function generate_person( $rank_min, $rank_max, $role, $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) {
	$upp = generate_stats($stat_parameters);
	$name = get_name($names);
	$rank = $rank_structure[rand($rank_min, $rank_max)];
	$age = 18 + rand(0,5) + $rank_min; 
	if ( rand(1,6) <=5 ) {
		$gender = 'Male';
	} else {
		$gender = 'Female';
	}
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
	echo "$rank $name, $upp $gender $age  ";
	echo "\n\t";
	foreach ($skill_array as $skill => $level) {
		echo "$skill - $level ";
	}
	echo "\n";
}
	
function generate_squad($troop_count, $stat_parameters, $names, $unit_id, $unit_number, $rank_structure, $base_skills, $all_skills) {
	
	$UNIT = $unit_id[$unit_number];
	echo "\n$UNIT Squad:\n";
	
	if ($UNIT == '1st') {
		generate_person( 6, 7, 'nco', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
		generate_person( 2, 3, 'medic', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	} else {
		generate_person( 5, 6, 'nco', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	}
	
	for ( $i = 1; $i <= $troop_count['troops_per_squad']; $i++) {
		if ( $i == 1) {
			echo "\n";
			generate_person( 3, 4, 'nco', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
		} elseif ($i == 5) {
			echo "\n";
			generate_person( 2, 3, 'troop', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
		} else {
			generate_person( 1, 1, 'troop', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
		}
	}
}

function generate_platoon($troop_count, $stat_parameters, $names, $unit_id, $unit_number, $rank_structure, $rank_structure, $base_skills, $all_skills) {

	$UNIT = $unit_id[$unit_number];
	echo "\n$UNIT Platoon: \n";
	
	if ( $UNIT == '1st') {	
		generate_person( 11, 11, 'officer', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	} else {
		generate_person( 10, 11, 'officer', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	}
		
	for ( $i = 1; $i <= $troop_count['squads_per_platoon']; $i++) {	
		generate_squad($troop_count, $stat_parameters, $names, $unit_id, $i , $rank_structure, $base_skills, $all_skills);
	}
}

function generate_company($troop_count, $stat_parameters, $names, $unit_id, $hq_staff_roles, $rank_structure, $rank_structure, $base_skills, $all_skills) {
	echo "Commander: \n";
	generate_person( 12, 13, 'officer', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	
	generate_hq_staff($hq_staff_roles, $stat_parameters, $names, $rank_structure, $base_skills, $all_skills);

	for ( $i = 1; $i <= $troop_count['platoons_per_company']; $i++ ) {
		generate_platoon($troop_count, $stat_parameters, $names, $unit_id, $i, $rank_structure, $rank_structure, $base_skills, $all_skills);
	}
}

function generate_hq_staff($hq_staff_roles, $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) {
	echo "HQ Platoon:\n";
	generate_person( 7, 9, 'nco', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 4, 6, 'medic', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'comm', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'sensors', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 2, 3, 'clerk', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 1, 2, 'driver', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
	generate_person( 1, 2, 'driver', $stat_parameters, $names, $rank_structure, $base_skills, $all_skills) ;
}

function open_web_page() {
	echo "<html><body><pre>";
}

function close_web_page() {
	echo "</pre></body></html>";
}

open_web_page();	
generate_company($troop_count, $stat_parameters, $names, $unit_id, $hq_staff_roles, $rank_structure, $rank_structure, $base_skills, $all_skills);
close_web_page();


?>

