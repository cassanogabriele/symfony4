<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{
    // Articles
    
    /**
     * @Route("/blog", name="blog")
     */

    // On dit qu'on a besoin d'une classe Repository, ArticleRepository $repo est une instance de la classe.
    public function index(ArticleRepository $repo): Response
    {
        // Accéder au "Respository"
        // $repo = $this->getDoctrine()->getRepository(Article::class);

        // Aller chercher un article dont le titre est celui définit entre "()"
        //  $articles = $repo->findOneByTitle('Titre de l\'article');
        // Trouver tous les articles qui ont ce titre
        // $articles = $repo->findByTitle('Titre de l\'article');
        
        // Trouver tous les articles
        $articles = $repo->findAll();
        
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            // Variable dans Twig qui contiendra le contenu de la variable "$articles"
            'articles' => $articles,
        ]);
    }

    /*
    Celle qui sera appelée pour la page d'accueil.
    Il faut lier cette fonction à une adresse particulière avec une anotation. 
    Il faut utliser des "" et pas de simples quotes. Le nom des routes est très important.
    Il faut ensuite créer le fichier "home.html.twig" au sein du dossier "blog".
    */ 

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // Appeler un fichier Twig pour l'afficher
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenue ici les amis !',
            'age' => 31
        ]);
    }
 
    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function form(Request $request, ObjectManager $manager)
    {
        $article = new Article();

        // Vérifiez si l'ID de l'article est présent dans la requête
        $articleId = $request->get('id');
        if ($articleId) {
            $article = $manager->getRepository(Article::class)->find($articleId);
        }

        // Bonne pratique de Symfony

        // Création d'un formulaire lié à l'article
        
        // Nettoyer le contenu HTML 
        $cleanedContent = strip_tags($article->getContent());
        $article->setContent($cleanedContent);


        // Si on génère le formulaire par ligne de commande
        $form = $this->createForm(ArticleType::class, $article);
        // Analyse de la requête HTTP passée en paramètre, si ça a été soumis ou pas
        $form->handleRequest($request);

        // Si le formulaire est soumis, on enregistre l'article (méthode de la classe Form)
        if ($form->isSubmitted() && $form->isValid()) {
            // On ne veut pas créer à chaque fois la date de création (dans le cas de l'édition)         
            
            // On créera une date de création uniquement si l'article n'existe pas
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            // Persister l'article
            $manager->persist($article);
            // Exécuter la requête
            $manager->flush();
            
            // Redirection vers la page de l'article qui vient d'être créé ou édité
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        // Méthode de l'objet Form, qui représente l'affichage du formulaire
        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null,
        ]);
    }


    // Voir un article cliqué

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id, Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->find($id);

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){   
            $now = new \DateTimeImmutable();

            $comment->setCreatedAt($now)
                    ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}