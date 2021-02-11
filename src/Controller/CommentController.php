<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController {

    /**
     * @Route("/comments/{id}/vote/{direction}")
     * @param $id
     * @param $direction
     * @return JsonResponse
     */
    public function commentVote($id, $direction): JsonResponse {
        if($direction === 'up') {
            $currentVote = rand(7, 100);
        } else {
            $currentVote = rand(0, 5);
        }

        return $this->json(['votes' => $currentVote]);
    }

}