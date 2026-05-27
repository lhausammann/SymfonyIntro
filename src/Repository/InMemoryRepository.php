<?php

namespace App\Repository;


use App\Entity\Game;
use App\NumberGuesserGame\RepositoryInterface;
use http\Exception\InvalidArgumentException;

/** In Memory allows to store and laod a game from memory */

class InMemoryRepository implements RepositoryInterface
{

  public function __construct(private int $lowerBound, private int $upperBound) {
      if ($this->lowerBound > $this->upperBound) {
          throw new InvalidArgumentException('Lower bound must be less than or equal to upper bound!');
      }
  }

  public function getBounds(): array {
      return [$this->lowerBound, $this->upperBound];
  }


    public array $memory = [];
    public function load(int $id): Game
    {
        if (!isset($this->memory[$id])) {
            throw new \Exception('Game not found!');
        }
        return $this->memory[$id];
    }

    public function create(): Game
    {
        $game = new Game(rand($this->lowerBound, $this->upperBound), count($this->memory));
        $this->memory[] = $game;
        return $this->memory[count($this->memory) - 1];
    }

    public function save(Game $game): void
    {
        // do nothing
    }
}
