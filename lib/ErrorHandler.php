<?php

declare(strict_types=1);

class ErrorHandler
{
    private ?string $errorMessage = null;


    public function setErrorMessage(): ?String
    {
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'missing_data':
                    return $this->errorMessage = 'Не забывайте выбрать корабли для битвы!';
                case 'bad_ships':
                    return $this->errorMessage = 'Вы сражаетесь с кораблями с неизвестной галактики?';
                case 'bad_quantities':
                    return $this->errorMessage = 'Вы уверены в количестве кораблей дле сражения?';
                default:
                    return $this->errorMessage = 'Что-то с войском не так. Попробуйте снова.';
            }
        } else {
            return '';
        }
    }

    public function getErrorMessage(): ?String
    {
        return $this->errorMessage;
    }
}
