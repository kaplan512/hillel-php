<?php
ini_set('display_errors', 'on');

require __DIR__.'/bootstrap.php';

$shipLoader = new ShipLoader();
$ships = $shipLoader->getShips();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Не забывайте выбрать корабли для битвы!';
            break;
        case 'bad_ships':
            $errorMessage = 'Вы сражаетесь с кораблями с неизвестной галактики?';
            break;
        case 'bad_quantities':
            $errorMessage = 'Вы уверены в количестве кораблей дле сражения?';
            break;
        default:
            $errorMessage = 'Что-то с войском не так. Попробуйте снова.';
    }
}
?>

<html lang="ru">
    <head>
        <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Космическая битва!</title>

           <!-- Bootstrap -->
           <link href="css/bootstrap.min.css" rel="stylesheet">
           <link href="css/style.css" rel="stylesheet">
           <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

           <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
           <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
           <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->
    </head>

    <?php if (!empty($errorMessage)): ?>
        <div>
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <body>
        <div class="container">
            <div class="page-header">
                <h1>Космическая битва</h1>
            </div>
            <table class="table table-hover">
                <caption><i class="fa fa-rocket"></i> Корабли готовы к следующей Миссии</caption>
                <thead>
                    <tr>
                        <th>Корабль</th>
                        <th>Атака</th>
                        <th>Сила Джедая</th>
                        <th>Прочность</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ships as $ship): ?>
                        <tr>
                            <td><?php echo $ship->getName(); ?></td>
                            <td><?php echo $ship->getWeaponPower(); ?></td>
                            <td><?php echo $ship->getJediFactor(); ?></td>
                            <td><?php echo $ship->getStrength(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="battle-box center-block border">
                <div>
                    <form method="POST" action="/battle.php">
                        <h2 class="text-center">Миссия</h2>
                        <input class="center-block form-control text-field" type="text" name="ship1_quantity" placeholder="Enter Number of Ships" />
                        <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="ship1_name">
                            <option value="">Выберите корабль</option>
                            <?php foreach ($ships as $key => $ship): ?>
                                <option value="<?php echo $key; ?>"><?php echo $ship->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <p class="text-center">Противник</p>
                        <br>
                        <input class="center-block form-control text-field" type="text" name="ship2_quantity" placeholder="Enter Number of Ships" />
                        <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="ship2_name">
                            <option value="">Выберите корабль</option>
                            <?php foreach ($ships as $key => $ship): ?>
                                <option value="<?php echo $key; ?>"><?php echo $ship->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <button class="btn btn-md btn-danger center-block" type="submit">В атаку!</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
