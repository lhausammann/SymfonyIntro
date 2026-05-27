<?php

namespace App\NumberGuesserGame;

enum GuessResult {
    case Lower;
    case Bigger;
    case Equals;
}
