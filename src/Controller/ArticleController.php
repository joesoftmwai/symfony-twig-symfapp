<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    // /**
    //  * @Route("/")
    //  * @Method({"GET"})
    //  */
    // public function index()
    // {
    //     // return new Response('<html><body>I am in symfony mate</body></html>');

    //     $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
    //     return $this->render('articles/index.html.twig', array('articles' => $articles));
    // }

    // /**
    //  * @Route("/article/new", name="new_article")
    //  * Method({"GET", "POST"})
    //  */

    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createFormBuilder()
            ->add('title', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('body', TextareaType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-primary mt-3'),
                'label' => 'Create'
            ))
            ->getForm();

        return $this->render('articles/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/article/{id}")
     * 
     */

    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', array('article' => $article));
    }

    // /**
    //  * @Route("/article/save")
    //  */
    // public function save()
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $article = new Article();
    //     $article->setTitle('title');
    //     $article->setBody('The body for the article goes here');

    //     // take the dump
    //     $entityManager->persist($article);
    //     // then flush it
    //     $entityManager->flush();

    //     $response = [
    //         "success" => true,
    //         "message" => "Article created successfully",
    //         "jsonData" => $article
    //     ];

    //     return new Response(json_encode($response));
    // }
}
