<?php
ini_set('display_errors', 'on');
require __DIR__ . '/bootstrap.php';

$shipLoader = new ShipLoader();
$ships = $shipLoader->getShips();

$ship1Name = $_POST['ship1_name'] ?? null;
$ship1Quantity = $_POST['ship1_quantity'] ?? 1;
$ship2Name = $_POST['ship2_name'] ?? null;
$ship2Quantity = $_POST['ship2_quantity'] ?? 1;

if ($ship1Name === null || $ship2Name === null) {
    header('Location: /index.php?error=missing_data');
    die();
}

if (!isset($ships[$ship1Name], $ships[$ship2Name])) {
    header('Location: /index.php?error=bad_ships');
    die();
}

if ($ship1Quantity <= 0 || $ship2Quantity <= 0) {
    header('Location: /index.php?error=bad_quantities');
    die();
}

$ship1 = $ships[$ship1Name];
$ship2 = $ships[$ship2Name];

$battleManager = new BattleManager();
$battleResult = $battleManager->battle(
        $ship1,
        $ship1Quantity,
        $ship2,
        $ship2Quantity
);

$sessionManager = new SessionManager();
$finishedFights = $sessionManager->getSessionValue('fights');
?>

<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Космическая битва</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Космическая битва</h1>
    </div>
    <div>
        <h2 class="text-center">Столкновение:</h2>
        <p class="text-center">
            <br>
            <?php
            echo $ship1Quantity; ?> <?php
            echo $ship1->getName(); ?><?php
            echo $ship1Quantity > 1 ? 's' : ''; ?>
            VS.
            <?php
            echo $ship2Quantity; ?> <?php
            echo $ship2->getName(); ?><?php
            echo $ship2Quantity > 1 ? 's' : ''; ?>
        </p>
    </div>
    <div class="result-box center-block">
        <h3 class="text-center audiowide">
            Winner:
            <?php
            if ($battleResult->isHereAWinner()): ?>
                <?php
                echo $battleResult->getWinningShip()->getName(); ?>
            <?php
            else: ?>
                Ничья
            <?php
            endif; ?>

            <h3>Остаток прочности</h3>
            <dl class="dl-horizontal">
                <dt><?php echo $ship1->getName(); ?></dt>
                <dd><?php echo $ship1->getStrength(); ?></dd>
                <dt><?php echo $ship2->getName(); ?></dt>
                <dd><?php echo $ship2->getStrength(); ?></dd>
            </dl>
        </h3>
        <p>
            Всего боев проведено: <?php echo $battleResult->getAmountOfFights(); ?>
        </p>
        <p class="text-center">
            <?php
            if (!$battleResult->isHereAWinner()): ?>

                Корабли уничтожили друг друга в эпической битве.
            <?php
            else: ?>
                <?php echo $battleResult->getWinningShip()->getName(); ?>
                <?php
                if ($battleResult->isUsedJediPowers()): ?>
                    использовал свои Силу Джедая для ошеломляющей победы!
                <?php
                else: ?>
                    одолели и уничтожили  <?php
                    echo $battleResult->getLosingShip()->getName() ?>s
                <?php
                endif; ?>
            <?php
            endif; ?>
        </p>
    </div>
    <a href="/index.php"><p class="text-center"><i class="fa fa-undo"></i> Снова в бой</p></a>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</div>
</body>
</html>
