<?php

namespace App\NumberGuesserGame;


interface GuesserInterface
{
    public function getId(): int;
    public function guess(int $guess): GuessResult;
}
