<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\GameRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class NumberGuessController extends AbstractController
{
    #[Route('/')]
    public function index(GameRepository $repo): Response
    {
        $newGame = $repo->create();
        return new RedirectResponse($this->generateUrl('number_guess', ['id' => $newGame->getId()]));
    }

    #[Route('/game/{id}', name: 'number_guess', methods: ['POST', 'GET'])]
    public function game(int $id, GameRepository $repo, \Symfony\Component\HttpFoundation\Request $request): Response {
        try {
            $game = $repo->find($id);
            if (!$game) {
                throw new NotFoundHttpException('Game not found');
            }

            $result = null;
            if ($request->isMethod('POST') && $guess = $request->request->get('number')) {
                $result = $game->guess((int) $guess);
                $repo->save($game);
            }

            return $this->render('guess.html.twig', [
                'game' => $game,
                'result' => $result?->value,
                'guess' => $guess ?? null
            ]);


        } catch (EntityNotFoundException $e) {
            return new Response('Game not found', Response::HTTP_NOT_FOUND);
        }

    }
}
