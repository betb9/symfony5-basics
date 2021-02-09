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
    public function homepage() {
        return new Response('What a bewitching controller we have conjured!');
    }

    /**
     * @Route("/questions/{slug}")
     * @return Response
     */
    public function show($slug) {
        return new Response(sprintf(
            'Future page to show the question "%s"',
            $slug
        ));
    }

}