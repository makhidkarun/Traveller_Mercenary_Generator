<?php

// army_skills.php
// Pretty much from Book 4, 1981 version.
// Except for Mechanical vs Mechanci
$army_skills = array();

$army_skills['MOS']['Infantry'][1] = 'GunCbt';
$army_skills['MOS']['Infantry'][2] = 'GunCbt';
$army_skills['MOS']['Infantry'][3] = 'HvyWpn';
$army_skills['MOS']['Infantry'][4] = 'HvyWpn';
$army_skills['MOS']['Infantry'][5] = 'Vehicle';
$army_skills['MOS']['Infantry'][6] = 'Recon';
$army_skills['MOS']['Infantry'][7] = 'VaccSuit';

$army_skills['MOS']['Cavalry'][1] = 'Vehicle';
$army_skills['MOS']['Cavalry'][2] = 'Vehicle';
$army_skills['MOS']['Cavalry'][3] = 'Vehicle';
$army_skills['MOS']['Cavalry'][4] = 'HvyWpn';
$army_skills['MOS']['Cavalry'][5] = 'HvyWpn';
$army_skills['MOS']['Cavalry'][6] = 'Mechanic';
$army_skills['MOS']['Cavalry'][7] = 'Computer';

$army_skills['Life'][1] = 'Brawling';
$army_skills['Life'][2] = '+1 Str';
$army_skills['Life'][3] = 'Gambling';
$army_skills['Life'][4] = '+1 Dex';
$army_skills['Life'][5] = '+1 End';
$army_skills['Life'][6] = '+1 End';
$army_skills['Life'][7] = 'Gun-Pistol';
$army_skills['Life'][8] = '+1 Soc';
$army_skills['Life'][9] = '+1 Soc';

$army_skills['NCO'][1] = 'HvyWpn';
$army_skills['NCO'][2] = 'Mechanic';
$army_skills['NCO'][3] = 'Tactics';
$army_skills['NCO'][4] = 'HvyWpn';
$army_skills['NCO'][5] = 'Mechanic';
$army_skills['NCO'][6] = 'Tactics';
$army_skills['NCO'][7] = 'Leader';
$army_skills['NCO'][8] = 'Leader';
$army_skills['NCO'][9] = 'Admin';
$army_skills['NCO'][10] = 'Instruction';
$army_skills['NCO'][11] = 'Admin';


$rand_list = array_rand($army_skills['MOS']);
$rand_roll = rand(1,6);
$skill = $army_skills['MOS'][$rand_list][$rand_roll];

echo "Rolled a $rand_roll, so I have $skill from the $rand_list branch.\n";

?>

