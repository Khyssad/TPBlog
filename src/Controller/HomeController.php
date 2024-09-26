<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository)
    {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $recentArticles = $this->articleRepository->findRecentArticles(6);

        return $this->render('home/index.html.twig', [
            'articles' => $recentArticles
        ]);
    }
}