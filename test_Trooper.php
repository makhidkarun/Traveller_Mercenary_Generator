<?php

require_once 'Trooper.php';

//$new_guy = new Trooper($person_params);
//$name = $new_guy->name;
// echo "The new guy is called " . $name . " and is " . $new_guy->age  . " years old.\n";
// echo "Nice UPP: " . $new_guy->upp . ".\n";

$new_guy = new Trooper();

$welcome = "The new guy, " . $new_guy->name . ", is a ";
$welcome = $welcome . $new_guy->age . " year old " . $new_guy->gender . ".\n";

echo $welcome;


