<?php

namespace App\NumberGuesserGame;

enum GuessResult {
    case isLarger;
    case isLower;
    case hasWon;
}
