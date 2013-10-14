<?php

require_once 'Trooper.php';
//require_once 'TrooperParams.php';
//require_once 'NCOParams.php';
/*
$new_guy = new Trooper( new TrooperParams);
$desc = "The new ";
$desc .= $new_guy->get_rank();
$desc .= ", ";
$desc .= $new_guy->get_name();
$desc .= ", is a ";
$desc .=  $new_guy->getAge(); 
$desc .=  " year old "; 
$desc .= $new_guy->get_gender();
$desc .= " with a ";
$desc .= $new_guy->get_upp();
$desc .= " UPP";
$desc .= ".\n";

echo "$desc";
foreach ($new_guy->get_skills() as $skill => $level) {
    echo "$skill : $level\n";
}
echo "Skill tables: ";

foreach ($new_guy->get_skill_tables() as $table => $value ) {
    echo "$table ";
}
echo "\n";
$desc = '';
*/ 
$new_nco = new Trooper(new NCOParams);
$desc = "The new ";
$desc .= $new_nco->getMos();
$desc .= " ";
$desc .= $new_nco->getRank();
$desc .= ", ";
$desc .= $new_nco->getName();
$desc .= ", is a ";
$desc .=  $new_nco->getAge(); 
$desc .=  " year old "; 
$desc .= $new_nco->getGender();
$desc .= " with a ";
$desc .= $new_nco->getUpp();
$desc .= " UPP";
$desc .= ".\n";

echo "$desc";
foreach ($new_nco->getSkills() as $skill => $level) {
    echo "$skill : $level\n";
}

echo "Skill tables: ";

foreach ($new_nco->getSkillTables() as $table => $value ) {
    echo "$table ";
}
echo "\n";

$desc = '';

