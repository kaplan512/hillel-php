<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$configuration = [
    'db_dsn' => 'mysql:host=localhost;dbname=space_battle',
    'db_user' => 'space_battle',
    'db_password' => 'space_battle'
];

require __DIR__ . '/lib/Service/Container.php';
require __DIR__ . '/lib/Service/BattleManager.php';
require __DIR__ . '/lib/Service/ShipLoader.php';
require __DIR__ . '/lib/Service/BattleHistoryManager.php';
require __DIR__ . '/lib/Model/BattleResult.php';
require __DIR__ . '/lib/Model/Ship.php';
require __DIR__ . '/lib/Model/BattleHistory.php';

$container = new Container($configuration);
