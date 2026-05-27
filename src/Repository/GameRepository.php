<?php

namespace App\Repository;

use App\Entity\Game;
use App\NumberGuesserGame\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\InvalidArgumentException;

class GameRepository extends ServiceEntityRepository implements RepositoryInterface {

    public function __construct(private int $lowerBound, private int $upperBound, ManagerRegistry $registry) {
        parent::__construct($registry, Game::class);
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
        $game = new Game(rand($this->lowerBound, $this->upperBound));
        // create a new game and persist it to the database
        $this->getEntityManager()->persist($game);
        $this->getEntityManager()->flush();
        return $game;
    }
}

