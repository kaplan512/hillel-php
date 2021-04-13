<?php

declare(strict_types=1);

class SessionManager
{
    private function sessionStart(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function sessionIncrement(string $key): void
    {
        $this->sessionStart();
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = 1;
        } else {
            $_SESSION[$key]++;
        }
    }

    public function getSessionValue(string $key): int
    {
        $this->sessionStart();
        return $_SESSION[$key];
    }

}
