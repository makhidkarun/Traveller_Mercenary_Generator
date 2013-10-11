<?php

require_once 'Trooper.php';
//require_once 'person_class.php';
// require_once 'person_params.php';

$new_guy = new Trooper($person_params);
$name = $new_guy->name;
echo "The new guy is called " . $name . " and is " . $new_guy->age  . " years old.\n";
echo "Nice UPP: " . $new_guy->upp . ".\n";

