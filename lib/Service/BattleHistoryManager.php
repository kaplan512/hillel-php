<?php

declare(strict_types=1);
class BattleHistoryManager
{
    const LIMIT = 50;

    private PDO $pdo;

    private ShipLoader $shipLoader;

    private int $battleHistoryPages = 0;

    public function __construct(
        PDO $pdo,
        ShipLoader $shipLoader
    ) {
        $this->pdo = $pdo;
        $this->shipLoader = $shipLoader;
    }

    public function setWinner(
        int $first_participant_id,
        int $second_participant_id,
        int $first_participant_ships_amount,
        int $second_participant_ships_amount,
        ?int $winner_health_left,
        ?int $winner_id): void {
        $date = strtotime("now");
        $this->pdo->exec('INSERT INTO battle_history
            (
            first_participant_id,
            second_participant_id,
            first_participant_ships_amount,
            second_participant_ships_amount,
            winner_health_left,
            winner_id,
            date
            ) VALUES
            (' . $first_participant_id . ', 
            ' . $second_participant_id . ', 
            ' . $first_participant_ships_amount . ',
            ' . $second_participant_ships_amount . ',
            ' . $winner_health_left . ',
            ' . $winner_id . ',
            ' . $date . ')'
        );
    }

    public function getBattleHistory(?int $pageNumber): array
    {
        $offset = 0;
        if ($pageNumber !== null) {
            $offset = (self::LIMIT * $pageNumber) - self::LIMIT;
        }
        $statement = $this->pdo->prepare('SELECT * FROM battle_history ORDER BY date LIMIT ' . self::LIMIT . ' OFFSET ' . $offset . ';');
        $statement->execute();
        $dbBattleHistory = $statement->fetchAll(PDO::FETCH_ASSOC);
        $battleHistoryArr = [];

        foreach ($dbBattleHistory as $dbBattle) {
            $battleHistoryArr[] = new BattleHistory($dbBattle, $this->shipLoader);
        }

        return $battleHistoryArr;
    }

    public function getPages(): int
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) AS amount FROM battle_history;');
        $statement->execute();
        $battleHistoryAmount = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->battleHistoryPages = (int) ceil((int) $battleHistoryAmount[0]['amount'] / self::LIMIT);
        return $this->battleHistoryPages;
    }
}
