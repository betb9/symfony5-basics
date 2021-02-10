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
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}")
     * @param $slug
     * @return Response
     */
    public function show($slug): Response {
        $answers = [
          'Make sure your cat is sitting perfectly still!',
          'Honestly, I like furry shoes better than MY cat',
          'Maybe... try saying the spell backwards?'
        ];

        return $this->render('question/show.html.twig', [
            'question'  => ucwords(str_replace('-', ' ', $slug)),
            'answers'   => $answers
        ]);
    }

}