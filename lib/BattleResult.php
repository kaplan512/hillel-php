<?php

declare(strict_types=1);

class BattleResult
{
    private ?Ship $winningShip;

    private ?Ship $losingShip;

    private bool $usedJediPowers;

    public function __construct(
        ?Ship $winningShip,
        ?Ship $losingShip,
        bool $usedJediPowers
    ) {
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
        $this->usedJediPowers = $usedJediPowers;
    }

    public function getWinningShip(): ?Ship
    {
        return $this->winningShip;
    }

    public function getLosingShip(): ?Ship
    {
        return $this->losingShip;
    }

    public function isUsedJediPowers(): bool
    {
        return $this->usedJediPowers;
    }

    public function isHereAWinner(): bool
    {
        return $this->winningShip !== null;
    }

    public function getAmountOfFights(): int
    {
        $sessionManager = new SessionManager();
        return $sessionManager->getFinishedFightsAmount();
    }
}
