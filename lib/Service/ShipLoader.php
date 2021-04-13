<?php

declare(strict_types=1);

class ShipLoader
{
    private PDO $pdo;

    private array $ships = [];

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
        if (empty($this->ships)) {
            $statement = $this->pdo->prepare('SELECT * FROM ship;');
            $statement->execute();
            $dbShips = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbShips as $dbShip) {
                $this->ships[] = $this -> transformDataToShip($dbShip);
            }
        }
        return $this->ships;
    }

    public function find(int $id): ?Ship
    {
        $neededShip = null;
        if (empty($this->ships)) {
            $statement = $this->pdo->prepare('SELECT * FROM ship WHERE id = :id;');
            $statement->execute(['id' => $id]);
            $neededShip = $statement->fetch(PDO::FETCH_ASSOC);
            $neededShip = $this -> transformDataToShip($neededShip);

            if (!$neededShip) {
                return null;
            }
        } else {
            foreach($this->ships as $ship) {
                if ($id == $ship->getId()) {
                    $neededShip = $ship;
                    break;
                }
            }
        }
        return $neededShip;
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
}
