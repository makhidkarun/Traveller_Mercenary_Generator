<?php

require_once 'Trooper.php';

//$new_guy = new Trooper($person_params);
//$name = $new_guy->name;
// echo "The new guy is called " . $name . " and is " . $new_guy->age  . " years old.\n";
// echo "Nice UPP: " . $new_guy->upp . ".\n";

$new_guy = new Trooper('trooper');
$welcome = "The new guy, " . $new_guy->rank . ' '  . $new_guy->name . ", is a ";
$welcome = $welcome . $new_guy->age . " year old " . $new_guy->gender . ".\n" ;
$welcome = $welcome . 'Wow: ' . $new_guy->upp . ".\n";
echo $welcome;

$welcome = '';

$new_nco = new Trooper('nco');
$welcome = "The new guy, " . $new_nco->rank . ' '  . $new_nco->name . ", is a ";
$welcome = $welcome . $new_nco->age . " year old " . $new_nco->gender . ".\n";
$welcome = $welcome . 'Wow: ' . $new_nco->upp . ".\n";

echo $welcome;

