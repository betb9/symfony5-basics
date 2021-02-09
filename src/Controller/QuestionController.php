<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

class QuestionController extends AbstractController {

    /**
     * @Route("/")
     * @return Response
     */
    public function homepage(): Response {
        return new Response('What a bewitching controller we have conjured!');
    }

    /**
     * @Route("/questions/{slug}")
     * @param $slug
     * @return Response
     */
    public function show($slug): Response {
        return $this->render('question/show.html.twig', [
            'question'  => ucwords(str_replace('-', ' ', $slug))
        ]);
    }

}