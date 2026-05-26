<?php

declare(strict_types=1);

namespace App\Tests\NumberGuesserGame;

use App\NumberGuesserGame\GuessResult;
use App\NumberGuesserGame\InMemoryGame;
use PHPUnit\Framework\TestCase;

final class InMemoryGameTest extends TestCase
{
    public function testReturnsLowerWhenGuessIsTooSmall(): void
    {
        $game = new InMemoryGame();
        $game->init();

        $result = $game->guess(6);

        self::assertSame(GuessResult::Lower, $result);
    }

    public function testReturnsBiggerWhenGuessIsTooLarge(): void
    {
        $game = new InMemoryGame();
        $game->init();

        $result = $game->guess(8);

        self::assertSame(GuessResult::Bigger, $result);
    }

    public function testReturnsEqualsWhenGuessMatchesNumber(): void
    {
        $game = new InMemoryGame();
        $game->init();

        $result = $game->guess(7);

        self::assertSame(GuessResult::Equals, $result);
    }
}

