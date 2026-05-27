<?php

namespace App\Tests\NumberGuesserGame;

use App\Entity\GuessResult;
use App\Repository\InMemoryRepository;

class InMemoryRepositoryTest
{
    public function testCreateAndLoadGame(): void
    {
        $repository = new InMemoryRepository(5, 5);
        $game = $repository->create();
        $loadedGame = $repository->load($game->getId());

        assert($game->getId() === $loadedGame->getId(), "Loaded game ID should match created game ID");
        assert($game->guess(5) === $loadedGame->guess(5), "Guessing game guess");
        assert($game->guess(5 ) === GuessResult::Equals, "Guessing game guess");
    }
}
