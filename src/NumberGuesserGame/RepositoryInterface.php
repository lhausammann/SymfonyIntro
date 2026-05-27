<?php

namespace App\NumberGuesserGame;

interface RepositoryInterface
{
    public function load(int $id): Game;
    public function create(): Game;
}
