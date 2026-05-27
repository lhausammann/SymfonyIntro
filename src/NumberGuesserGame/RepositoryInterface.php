<?php

namespace App\NumberGuesserGame;

use App\Entity\Game;

interface RepositoryInterface
{
    public function load(int $id): Game;
    public function create(): Game;
}
