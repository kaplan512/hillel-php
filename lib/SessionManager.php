<?php

declare(strict_types=1);

class SessionManager
{
    public function sessionIncrement(string $key): void
    {
        session_start();
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = 1;
        } else {
            $_SESSION[$key]++;
        }
    }

    public function getSessionValue(string $key): int
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION[$key];
    }

}
