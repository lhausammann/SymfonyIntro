<?php

namespace App\NumberGuesserGame;

class Game implements GuesserInterface
{

    public function __construct(private int $gameId, private int $secretNumber)
    {}

    public function getId(): int {
        return $this->gameId;
    }

    public function guess(int $guess): GuessResult
    {
        switch ($guess) {
            case $guess < $this->secretNumber:
                return GuessResult::Lower;
            case $guess > $this->secretNumber:
                return GuessResult::Bigger;
            default:
                return GuessResult::Equals;
        }
    }
}
