<?php

require_once 'people_obj.php';

$kid = new Person($person_params);

$trooper = new Trooper($trooper_params);
$corporal = new Corporal($trooper_params);
$nco = new NCO($trooper_params);
$snco = new SNCO($trooper_params);
$platoon_officer = new Platoon_Officer($trooper_params);
$company_officer = new Company_Officer($trooper_params);

echo "The $kid->age year old $kid->gender's older $trooper->age year old $trooper->gender $trooper->rank visited with\n";
echo "The $trooper->rank was now trained in ";
foreach ($trooper->skills as $s => $v) {
	echo "$s - $v ";
}
echo "\n";

echo "In the distance a $platoon_officer->rank read new orders from the $company_officer->rank.\n";

var_dump($trooper);

?>
