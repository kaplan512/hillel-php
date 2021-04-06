<?php

require __DIR__ . '/lib/Ship.php';

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$myShip = new Ship('My Ship');
$otherShip = new Ship('Other Ship');
$otherShip->setStrength(100);
//$otherShip->strength = 50;

echo 'Ship name: ' . $myShip->getName();
echo '<br>';
//echo 'Ship weapon: ' . $myShip->weaponPower;
echo '<br>';
echo $myShip->getNameAndSpecs(false);
echo '<hr>';
echo $otherShip->getNameAndSpecs();

