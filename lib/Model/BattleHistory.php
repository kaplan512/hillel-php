<?php

declare(strict_types=1);

class BattleHistory
{
    private ShipLoader $shipLoader;

    private ?array $battle;

    public function __construct(
        ?array $battle,
        ShipLoader $shipLoader
    ) {
        $this->battle = $battle;
        $this->shipLoader = $shipLoader;
    }

    public function getFirstParticipant(): Ship
    {
        return $this->shipLoader->find((int) $this->battle['first_participant_id']);
    }

    public function getSecondParticipant(): Ship
    {
        return $this->shipLoader->find((int) $this->battle['second_participant_id']);
    }

    public function getWinner(): Ship
    {
        return $this->shipLoader->find((int) $this->battle['winner_id']);
    }

    public function getFirstParticipantShipsAmount(): int
    {
        return (int) $this->battle['first_participant_ships_amount'];
    }

    public function getSecondParticipantShipsAmount(): int
    {
        return (int) $this->battle['second_participant_ships_amount'];
    }

    public function getWinnerStrengths(): int
    {
        return (int) $this->battle['winner_health_left'];
    }

    public function getDate(): string
    {
        $date = new DateTime();
        $date->setTimestamp((int) $this->battle['date']);
        $date = $date->format('d-m-Y H:i:s');
        return $date;
    }
}
