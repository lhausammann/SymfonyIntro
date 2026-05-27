<?php

namespace App\Entity;

use App\NumberGuesserGame\GuesserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Game implements GuesserInterface
{

    public function __construct(

        #[ORM\Column(type: 'integer')]
        private int $secretNumber,
        #[ORM\Column(type: 'integer')]
        #[ORM\Id]
        #[ORM\GeneratedValue]
        private readonly ?int $id = null,
    ) {}

    public function getId(): int {
        return $this->id ?? 0;
    }

    public function guess(int $guess): GuessResult
    {
        switch ($guess) {
            case $guess < $this->secretNumber:
                return GuessResult::Lower;
            case $guess > $this->secretNumber:
                return GuessResult::Bigger;
            default:
                return GuessResult::Equals;
        }
    }
}
