<?php

declare(strict_types=1);

class ShipLoader
{
    private PDO $pdo;
    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }
    /**
     * @return Ship[]
     */
    public function getShips(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ship;');
        $statement->execute();
        $dbShips = $statement->fetchAll(PDO::FETCH_ASSOC);
        $ships = [];

        foreach ($dbShips as $dbShip) {
            $ships[] = $this -> transformDataToShip($dbShip);
        }

        return $ships;
    }

    public function find(int $id): ?Ship
    {
        $statement = $this->pdo->prepare('SELECT * FROM ship WHERE id = :id;');
        $statement->execute(['id' => $id]);
        $dbShip = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$dbShip) {
            return null;
        };

        return $this -> transformDataToShip($dbShip);
    }

    private function transformDataToShip(array $data): Ship
    {
        $ship = new Ship(
            $data['name'],
            (int) $data['weapon_power'],
            (int) $data['jedi_factor'],
            (int) $data['strength'],
        );
        $ship -> setId((int) $data['id']);

        return $ship;
    }

//    private function getPDO(): PDO
//    {
//        return $pdo;
//    }
}
