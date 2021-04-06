<?php

declare(strict_types=1);

class SessionManager
{
    public function setFinishedFightsAmount()
    {
        session_start();
        if (!isset($_SESSION['fights'])) {
            $_SESSION['fights'] = 0;
        } else {
            $_SESSION['fights']++;
        }
    }

    public function getFinishedFightsAmount(): int
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['fights'];
    }

}
