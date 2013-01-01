<?php

/* 
	Creates a Mercenary company for the Traveller RPG.
	version:	0.1
*/


require_once 'create_mercenary_unit_include.php';
require_once 'names.php';


####
## Main
####

open_web_page($troop_count, $stat_parameters,$_POST);	
generate_company($troop_count, $stat_parameters, $names, $unit_id, $hq_staff_roles, $rank_structure, $rank_structure, $base_skills, $all_skills);
close_web_page();


?>

