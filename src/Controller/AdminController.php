<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin')]
    public function index(GameRepository $repo): Response
    {
        $games = $repo->findAll();
        return $this->render('admin/index.html.twig', [
            'games' => $games
        ]);
    }
}
