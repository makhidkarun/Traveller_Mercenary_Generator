<?php

/*
    Creates a Mercenary company in JSON format for the Traveller RPG.
    version:    0.1
*/

require_once 'create_mercenary_unit_include.php';
require_once 'last_names.php';

$mercenary_js = fopen('mercenary.js', 'a');
generate_troops_json();
fclose($mercenary_js);

?>
