<?php

declare(strict_types=1);

namespace App\Tests\NumberGuesserGame;

use App\NumberGuesserGame\GuessResult;
use PHPUnit\Framework\TestCase;

final class GuessResultTest extends TestCase
{
    public function testEnumContainsExpectedCases(): void
    {
        $cases = GuessResult::cases();

        self::assertCount(3, $cases);
        self::assertSame('Lower', $cases[0]->name);
        self::assertSame('Bigger', $cases[1]->name);
        self::assertSame('Equals', $cases[2]->name);
    }
}

