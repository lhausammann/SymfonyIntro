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
                return GuessResult::Lower;
            case $guess > $this->numberToGuess:
                return GuessResult::Bigger;
            default:
                return GuessResult::Equals;
        }
    }
}
