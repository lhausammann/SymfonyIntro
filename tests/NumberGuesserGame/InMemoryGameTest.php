<?php

declare(strict_types=1);

namespace App\Tests\NumberGuesserGame;

use App\Entity\Game;
use App\Entity\GuessResult;
use PHPUnit\Framework\TestCase;

final class InMemoryGameTest extends TestCase
{
    public function testReturnsLowerWhenGuessIsTooSmall(): void
    {
        $game = new Game(7, 1);


        $result = $game->guess(6);

        self::assertSame(GuessResult::Lower, $result);
    }

    public function testReturnsBiggerWhenGuessIsTooLarge(): void
    {
        $game = new Game(7);

        $result = $game->guess(8);

        self::assertSame(GuessResult::Bigger, $result);
    }

    public function testReturnsEqualsWhenGuessMatchesNumber(): void
    {
        $game = new Game(7);


        $result = $game->guess(7);

        self::assertSame(GuessResult::Equals, $result);
    }
}

