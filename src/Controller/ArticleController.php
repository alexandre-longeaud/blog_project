<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\AddCommentType;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article, UserRepository $userRepo, Request $request, EntityManagerInterface $em): Response
    {
        
        // Condition : si $article n'existe pas, on redirige vers la page d'accueil
        if(!$article){

            return $this->redirectToRoute('app_home');
        }


        //Le constructeur dans l'entité article permet d'associé un commentaire à un article, soit en paramètre de cette instance de Comment
        $comment = new Comment();
        

        $commentForm = $this->createForm(AddCommentType::class,$comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $comment->setArticle($article);
            $comment->setUser($userRepo->findOneBy(['id'=>1]));
            $comment->setCreatedAt(new \DateTime());

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Commentaire bien ajouté');

            return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'form'=> $commentForm
        ]);
    }
}
