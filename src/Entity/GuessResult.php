<?php

namespace App\Entity;

enum GuessResult: string {
    case Lower = '<';
    case Bigger = '>';
    case Equals = '=';
}
