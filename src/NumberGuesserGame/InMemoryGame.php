<?php

namespace App\NumberGuesserGame;

class InMemoryGame implements GuesserInterface
{
    private int $numberToGuess;


    public function init(): void
    {
        $this->numberToGuess = 7;
    }

    public function guess(int $guess): GuessResult
    {
        switch ($guess) {
            case $guess < $this->numberToGuess:
                return GuessResult::isLower;
            case $guess > $this->numberToGuess:
                return GuessResult::isLarger;
            default:
                return GuessResult::hasWon;
        }
    }
}
