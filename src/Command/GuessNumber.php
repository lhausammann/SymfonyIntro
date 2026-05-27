<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\GuessResult;
use App\NumberGuesserGame\GuesserInterface;
use App\Repository\InMemoryRepository;
use RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:guess-number',
    description: 'Play a simple number guessing game.',
)]
final class GuessNumber extends Command
{
    private GuesserInterface $game;
    public function __construct(readonly InMemoryRepository $repository)
    {
        $this->game = $repository->create();
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $io->title('Guess the number 🎯');
        $io->writeln('I picked a number. Try to find it! 🤔');

        while (true) {
            $guess = $io->ask('Your guess', null, static function (mixed $value): int {
                if (null === $value || false === filter_var($value, FILTER_VALIDATE_INT)) {
                    throw new RuntimeException('Please enter a valid integer.');
                }

                return (int) $value;
            });

            $result = $this->game->guess($guess);

            if (GuessResult::Lower === $result) {
                $io->writeln('Too low 📉 Try a bigger number. ⬆️');
                continue;
            }

            if (GuessResult::Bigger === $result) {
                $io->writeln('Too high 📈 Try a smaller number. ⬇️');
                continue;
            }

            $io->success(sprintf('Correct! %d is the right number 🎉', $guess));

            return Command::SUCCESS;
        }
    }
}
