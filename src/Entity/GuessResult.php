<?php

namespace App\Entity;

enum GuessResult {
    case Lower;
    case Bigger;
    case Equals;
}
