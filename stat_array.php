<?php

$person_params = array();


$trooper_params = array();
$trooper_params['min_phy_stat'] = 6;
$trooper_params['min_men_stat'] = 5;
$trooper_params['min_stat'] = 2;
$trooper_params['max_stat'] = 12;
$trooper_params['percent_male'] = 75;


$trooper_params['rank_enlisted'] = array();
$trooper_params['rank_enlisted']['1'] = 'PVT';
$trooper_params['rank_enlisted']['2'] = 'PV2';
$trooper_params['rank_enlisted']['3'] = 'PFC';
$trooper_params['rank_enlisted']['4'] = 'CPL';
$trooper_params['rank_enlisted']['5'] = 'SGT';
$trooper_params['rank_enlisted']['6'] = 'SSG';
$trooper_params['rank_enlisted']['7'] = 'SFC';
$trooper_params['rank_enlisted']['8'] = 'MSG';
$trooper_params['rank_enlisted']['9'] = 'SGM';
$trooper_params['rank_officer']['1'] = '2LT';
$trooper_params['rank_officer']['2'] = '1LT';
$trooper_params['rank_officer']['3'] = 'CPT';
$trooper_params['rank_officer']['4'] = 'MAJ';
$trooper_params['rank_officer']['5'] = 'LTC';
$trooper_params['rank_officer']['6'] = 'COL';
$trooper_params['rank_officer']['7'] = 'BG';
$trooper_params['rank_officer']['8'] = 'MG';
$trooper_params['rank_officer']['9'] = 'LTG';
$trooper_params['rank_officer']['10'] = 'GEN';

$trooper_params['base_skill']['troop'] = 'GunCbt';
$trooper_params['base_skill']['medic'] = 'Medic';
$trooper_params['base_skill']['nco'] = 'Leadership';
$trooper_params['base_skill']['company_officer'] = 'Leadership';
$trooper_params['base_skill']['driver'] = 'Drive';
$trooper_params['base_skill']['clerk'] = 'Admin';
$trooper_params['base_skill']['comm'] = 'Commo';
$trooper_params['base_skill']['sensors'] = 'Sensors';


?>
