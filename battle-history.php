<?php
ini_set('display_errors', 'on');
require __DIR__ . '/bootstrap.php';

$battleManager = $container->getBattleHistoryManager();
if (isset($_GET['page'])) {
    $battleResults = $battleManager->getBattleHistory($_GET['page']);
} else {
    $battleResults = $battleManager->getBattleHistory(1);
}

$pages = $container->getBattleHistoryManager()->getPages();

$showPagination = '';
if($pages <= 1){
    $showPagination = "style='display:none;'";
}

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
        <h1>История боев</h1>

        <table class="table table-hover">
            <caption><i class="fa fa-rocket"></i> Корабли готовы к следующей Миссии</caption>
            <thead>
            <tr>
                <th>Участник 1</th>
                <th>Участник 2</th>
                <th>Количество кораблей участника 1</корабле></th>
                <th>Количество кораблей участника 2</th>
                <th>Победитель</th>
                <th>Оставшееся здоровье</th>
                <th>Время поединка</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($battleResults as $result): ?>
                <tr>
                    <td><?php echo $result->getFirstParticipant()->getName(); ?></td>
                    <td><?php echo $result->getSecondParticipant()->getName(); ?></td>
                    <td><?php echo $result->getFirstParticipantShipsAmount(); ?></td>
                    <td><?php echo $result->getSecondParticipantShipsAmount(); ?></td>
                    <td><?php echo $result->getWinner()->getName(); ?></td>
                    <td><?php echo $result->getWinnerStrengths(); ?></td>
                    <td><?php echo $result->getDate(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pagination" <?php echo $showPagination;?>>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <div class="pagination-item">
                <form action="/battle-history.php" method="GET">
                    <input type="hidden" name="page" value="<?php echo $i; ?>" />
                    <button type="submit">
                        <?php echo $i; ?>
                    </button>
                </form>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <a href="/index.php"><p class="text-center"><i class="fa fa-undo"></i> Назад в бой</p></a>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</div>
</body>
</html>

