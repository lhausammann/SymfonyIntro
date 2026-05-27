<?php

namespace App\NumberGuesserGame;


use App\Entity\GuessResult;

interface GuesserInterface
{
    public function getId(): int;
    public function guess(int $guess): GuessResult;
}
