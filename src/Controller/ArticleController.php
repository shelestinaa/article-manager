<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'article', methods: ['GET'])]
    public function showById(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        return $this->json($entityManager->getRepository(Article::class)->find($id));
    }

}