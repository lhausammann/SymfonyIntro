<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class HistoryEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'historyEntries', cascade: ['persist', 'remove'])]

    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Game $game;

    #[ORM\Column(type: 'integer')]
    private int $guess;

    #[ORM\Column(type: 'string', enumType: GuessResult::class)]
    private GuessResult $result;

    public function __construct(Game $game, int $guess, GuessResult $result)
    {
        $this->game = $game;
        $this->guess = $guess;
        $this->result = $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function getGuess(): int
    {
        return $this->guess;
    }

    public function getResult(): GuessResult
    {
        return $this->result;
    }

    public function __toString(): string
    {
        return sprintf('%s %s ausgedachte Zahl', $this->guess, $this->result->value);
    }
}
