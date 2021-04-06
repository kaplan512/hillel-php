<?php

declare(strict_types=1);

class BattleManager
{
    public function battle(
        Ship $ship1,
        int $ship1Quantity,
        Ship $ship2,
        int $ship2Quantity
    ): BattleResult {
        $ship1Health = $ship1->getStrength() * $ship1Quantity;
        $ship2Health = $ship2->getStrength() * $ship2Quantity;

        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;
        while ($ship1Health > 0 && $ship2Health > 0) {
            if ($this->isJediDestroyShipUsingTheForce($ship1)) {
                $ship2Health = 0;
                $ship1UsedJediPowers = true;

                break;
            }
            if ($this->isJediDestroyShipUsingTheForce($ship2)) {
                $ship1Health = 0;
                $ship2UsedJediPowers = true;

                break;
            }

            $ship1Health -= ($ship2->getWeaponPower() * $ship2Quantity);
            $ship2Health -= ($ship1->getWeaponPower() * $ship1Quantity);
        }

        if ($ship1Health <= 0 && $ship2Health <= 0) {
            $winningShip = null;
            $losingShip = null;
            $usedJediPowers = $ship1UsedJediPowers || $ship2UsedJediPowers;
        } elseif ($ship1Health <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
        }

        $ship1->setStrength($ship1Health);
        $ship2->setStrength($ship2Health);

        $sessionManager = new SessionManager();
        $sessionManager->setFinishedFightsAmount();

        return new BattleResult(
            $winningShip,
            $losingShip,
            $usedJediPowers
        );
    }

    private function isJediDestroyShipUsingTheForce(Ship $ship): bool
    {
        return mt_rand(1, 100) <= $ship->getJediFactor();
    }
}
