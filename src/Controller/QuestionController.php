<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController {

    /**
     * @Route("/")
     * @return Response
     */
    public function homepage() {
        return new Response('What a bewitching controller we have conjured!');
    }

}