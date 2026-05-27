<?php

namespace App\Entity;

use App\NumberGuesserGame\GuesserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Game implements GuesserInterface
{
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: HistoryEntry::class)]
    private Collection $historyEntries;

    public function __construct(
        #[ORM\Column(type: 'integer')]
        private int $secretNumber,
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: 'integer')]
        private ?int $id = null
    ) {
        $this->historyEntries = new ArrayCollection();
    }

    public function getId(): int {
        return $this->id;
    }

    public function isOver(): bool {

        foreach ($this->historyEntries as $historyEntry) {
            if ($historyEntry->getResult() === GuessResult::Equals) {
                return true;
            }
        }
        return false;
    }

    public function getHistory(): Collection
    {
        return $this->historyEntries;
    }

    protected function addHistory(int $guess, GuessResult $result): HistoryEntry
    {
        $entry = new HistoryEntry($this, $guess, $result);
        $this->historyEntries->add($entry);

        return $entry;
    }

    public function guess(int $guess): GuessResult
    {
        $result = null;
        switch ($guess) {
            case $guess < $this->secretNumber:
                $result = GuessResult::Lower;
                break;
            case $guess > $this->secretNumber:
                $result = GuessResult::Bigger;
                break;
            default:
                $result = GuessResult::Equals;
                break;
        }
        $this->addHistory($guess, $result);
        return $result;
    }
}
