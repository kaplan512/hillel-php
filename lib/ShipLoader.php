<?php

declare(strict_types=1);

class ShipLoader
{
    /**
     * @return Ship[]
     */
    public function getShips(): array
    {
        $ships = [];
        $ship = new Ship(
            'Jedi Starfighter',
            5,
            15,
            30
        );
        $ships['starfighter'] = $ship;

        $ship2 = new Ship(
            'CloakShape Fighter',
            2,
            2,
            70
        );
        $ships['cloakshape_fighter'] = $ship2;

        $ship3 = new Ship(
            'Super Star Destroyer',
            70,
            0,
            500
        );
        $ships['super_star_destroyer'] = $ship3;

        $ship4 = new Ship(
            'RZ-1 A-wing interceptor',
            4,
            4,
            50
        );
        $ships['rz1_a_wing_interceptor'] = $ship4;

        return $ships;
    }
}