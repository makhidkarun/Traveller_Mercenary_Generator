<?php

/*
    Creates a Mercenary company for the Traveller RPG.
    version:    0.1
*/


require_once 'create_mercenary_unit_include.php';
require_once 'last_names.php';

/* Defaults */ 
$troop_count = array ( 'troops_per_squad' => 8, 'squads_per_platoon' => 3, 'platoons_per_company' => 4);
$stat_parameters = array ('min_stat' => 2,'min_physical_stat' => 6,'min_mental_stat' => 5,'max_stat' => 10);
 
/* Change from defaults if requested. */
if (array_key_exists('_submit_check', $_POST)) {
    foreach($troop_count as $k => $v) {
        if (isset($_POST[$k]) && is_numeric($_POST[$k])) {
            $troop_count[$k] = $_POST[$k];
        }
    }
    foreach($stat_parameters as $k => $v) {
        if (isset($_POST[$k]) && is_numeric($_POST[$k])) {
            $stat_parameters[$k] = $_POST[$k];
        }
    }
	foreach ($stat_parameters as $k => $v ) {
		if ( $stat_parameters[$k] > $stat_parameters['max_stat']) {
			$stat_parameters[$k] = $stat_parameters['max_stat'];
		} else if ($stat_parameters[$k] < $stat_parameters['min_stat']) {
			$stat_parameters[$k] = $stat_parameters['min_stat'];
		}
	}

}

/* Write the page */
echo <<< _HTML_
    <html>
    <head>
        <title>LH Traveller Mercenary Generator</title>
    </head>
    <body>
    <h2>Traveller Mercenary Generator</h2>
    <p>Adjust defaults if you want and then hit "Sign them up!"

    <form method="POST" action="{$_SERVER['PHP_SELF']}">
    <table cellpadding="20" width="90%">
    <tr><td align="top">
    <h3>Individual Stat Parameters</h3>
    <p>Minimum Stat (2-15)
        <input type="number" min="2" max="15" name="min_stat" value="{$stat_parameters['min_stat']}" size="5">
    <p>Minimum Physical Stat (2-15)
        <input type="number" min="2" max="15" name="min_physical_stat" value="{$stat_parameters['min_physical_stat']}" size="5">
    <p>Minimum Mental Stat (2-15)
        <input type="number" min="2" max="15"name="min_mental_stat" value="{$stat_parameters['min_mental_stat']}" size="5">
    <p>Maximum Stat (2-15)
        <input type="number" min="2" max="15" name="max_stat" value="{$stat_parameters['max_stat']}" size="5">
    </td>
    <td align="top">
    <h3>TOE Parameters</h3>

    <p>Troops per Squad (1-15)
        <input type="number" min="1" max="15" name="troops_per_squad" value="{$troop_count['troops_per_squad']}" size ="5">
    <p>Squads Per Platoon (1-8 )
        <input type="number" min="1" max="8" name="squads_per_platoon" value="{$troop_count['squads_per_platoon']}" size ="5">
    <p>Platoons per Company (1-8)
        <input type="number" min="1" max="8" name="platoons_per_company" value="{$troop_count['platoons_per_company']}" size ="5">

    <br>
    <input type="hidden" name="_submit_check" value="1">
    <input type="submit" value="Sign them up!" name="submit">

    </td></tr>
    </table>
    </form>

    <hr>
    <pre>

_HTML_;

generate_company($troop_count, $stat_parameters, $last_names, $male_first_names, $female_first_names, $unit_id, $hq_staff_roles, $rank_structure, $rank_structure, $base_skills, $all_skills);


close_web_page();
?>
