<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\AddCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article): Response
    {
        // Condition : si $article n'existe pas, on redirige vers la page d'accueil
        if(!$article){

            return $this->redirectToRoute('app_home');
        }

        //Le constructeur dans l'entité article permet d'associé un commentaire à un article, soit en paramètre de cette instance de Comment
        $comment = new Comment($article);

        $commentForm = $this->createForm(AddCommentType::class,$comment);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'form'=> $commentForm
        ]);
    }
}
