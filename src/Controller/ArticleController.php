<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ArticleController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository)
    {
    }

    #[Route('/articles', name: 'app_article_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $this->articleRepository->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC');

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10 // Nombre d'articles par page
        );

        return $this->render('article/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/article/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $article = $this->articleRepository->find($id);

        if (!$article) {
            throw $this->createNotFoundException('L\'article demandé n\'existe pas');
        }

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}