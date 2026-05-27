<?php

namespace App\Repository;

use App\Entity\Game;
use App\NumberGuesserGame\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use http\Exception\InvalidArgumentException;

class GameRepository extends ServiceEntityRepository implements RepositoryInterface {

    public function __construct(private int $lowerBound, private int $upperBound) {
        if ($this->lowerBound > $this->upperBound) {
            throw new InvalidArgumentException('Lower bound must be less than or equal to upper bound!');
        }
    }
    public function load(int $id): Game
    {
        return $this->getEntityManager()->getRepository(Game::class)->find($id);
    }

    public function create(): Game
    {
        return new Game();
    }
}

