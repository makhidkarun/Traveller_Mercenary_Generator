<?php

/*
	Include File of functions for create_mercenary_unit.php
	version 0.1
*/

$troop_count = array (
	'troops_per_squad' => 8,
	'squads_per_platoon' => 3,
	'platoons_per_company' => 4);

$hq_staff_roles = array (
	0 => '1st Sgt',
	1 => 'Fwd Obs',
	2 => 'Comms ', 
	3 => 'Sensors',
	4 => 'Medic ',
	5 => 'Driver',
	6 => 'Driver',
	7 => 'Clerk ');

$stat_parameters = array (
	'MIN_STAT' => 2,
	'MIN_PHY_STAT' => 6,
	'MIN_MENTAL_STAT' => 5,
	'MAX_STAT' => 10);

$unit_id = array(
	1 => '1st',
	2 => '2nd',
	3 => '3rd',
	4 => '4th',
	5 => '5th',
	6 => '6th'
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

?>

