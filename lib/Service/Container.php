<?php

declare(strict_types=1);

class Container
{
    private array $configuration;

    private ?PDO $pdo = null;

    private ?BattleManager $battleManager = null;

    private ?ShipLoader $shipLoader = null;

    public function __construct
    (
        array $configuration
    ) {
        $this->configuration = $configuration;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getBattleManager(): BattleManager
    {
        if ($this->battleManager === null) {
            $this->battleManager = new BattleManager();
        }

        return $this->battleManager;
    }

    public function getShipLoader(): ShipLoader
    {
        if ($this->shipLoader === null) {
            $this->shipLoader = new ShipLoader($this->getPDO());
        }

        return $this->shipLoader;
    }
}
