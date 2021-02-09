<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

class QuestionController {

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
        return new Response(sprintf(
            'Future page to show the question "%s"',
            ucwords(str_replace('-', ' ', $slug))
        ));
    }

}