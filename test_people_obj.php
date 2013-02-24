<?php

require_once 'mercenary_class.php';


$kid = new Person($person_params);

echo "$kid->name , Age $kid->age Gender $kid->gender\n";
echo "$kid->upp \n";
$str = substr($kid->upp, 0,1);
$str = hexdec($str);
echo "Wow, the kid has a $str strength!\n";
echo "\n\n";

function generate_squad($trooper_params, $person_params) {

	$trooper = new Trooper($trooper_params, $person_params);
	$corporal = new Corporal($trooper_params, $person_params);
	$nco = new NCO($trooper_params, $person_params);
	$snco = new SNCO($trooper_params, $person_params);
	$platoon_officer = new Platoon_Officer($trooper_params, $person_params);
	$company_officer = new Company_Officer($trooper_params, $person_params);
 
	echo "$trooper->rank $trooper->name ,  Age $trooper->age Gender $trooper->gender\n";
	echo "$trooper->upp \n";
	foreach ($trooper->skills as $s => $v) {
		echo "$s" . "-" . "$v ";
	}

	echo "\n\n";
	$medic = new Trooper($trooper_params, $person_params);
	$medic->change_role($trooper_params, 'medic');

	echo "Medic:  $medic->rank $medic->upp $medic->gender  $medic->age\n";
	foreach ($medic->skills as $s => $v) {
		echo "$s" . "-" . "$v ";
	}

	echo "\n\n";
	echo "SNCO:  $snco->rank $snco->upp $snco->gender $snco->age\n";
	foreach ($snco->skills as $s => $v) {
		echo "$s" . "-" . "$v ";
	}
	echo "\n\n";
	
	echo "LT:  $platoon_officer->rank $platoon_officer->upp $platoon_officer->gender $platoon_officer->age\n";
	foreach ($platoon_officer->skills as $s => $v) {
		echo "$s" . "-" . "$v ";
	}
	echo "\n\n";


	echo "CO:  $company_officer->rank $company_officer->upp $company_officer->gender $company_officer->age\n";
	foreach ($company_officer->skills as $s => $v) {
		echo "$s" . "-" . "$v ";
	}
	echo "\n\n";
}

generate_squad();

?>
