<?php

namespace App\NumberGuesserGame;


interface GuesserInterface
{
    public function init(): void;
    public function guess(int $guess): GuessResult;
}
