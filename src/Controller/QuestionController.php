<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    private $logger;
    private $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug)
    {
        $this->logger = $logger;
        $this->isDebug = $isDebug;
    }


    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(QuestionRepository $repository)
    {
    	$questions = $repository->findAllAskedOrderByNewest();

      return $this->render('question/homepage.html.twig', [
      	'questions' => $questions
      ]);
    }

	/**
	 * @Route("/questions/new")
	 * @param EntityManagerInterface $entityManager
	 * @return Response
	 * @throws \Exception
	 */
	public function new(EntityManagerInterface $entityManager) {
		$question = new Question();
		$question->setName('Missing pants')
			->setSlug('missing-pants-'.rand(0, 1000))
			->setQuestion('Hi, I\'m having a *weird* day. Does anyone have a spell to call your pants back?');

		if(rand(1, 10) > 2) {
			$question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
		}

		$question->setVotes(rand(-20, 50));

		$entityManager->persist($question);
		$entityManager->flush();

		return new Response(sprintf('Well hallo! The shiny new question is id #%d, slug %s',
		$question->getId(), $question->getSlug()));
	}

	/**
	 * @Route("/questions/{slug}", name="app_question_show")
	 * @param Question $question
	 * @return Response
	 */
    public function show(Question $question): Response
    {
        if ($this->isDebug) {
            $this->logger->info('We are in debug mode!');
        }

        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];


        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }

	/**
	 * @Route("/questions/{slug}/vote", name="app_question_vote", methods="POST")
	 * @param Question $question
	 * @param Request $request
	 * @param EntityManagerInterface $entityManager
	 */
    public function questionVote(Question $question, Request $request, EntityManagerInterface $entityManager): RedirectResponse
    {
			$direction = $request->request->get('direction');
			if($direction === 'up') {
				$question->upVotes();
			} elseif($direction === 'down') {
				$question->downVotes();
			}
			$entityManager->flush();
			return $this->redirectToRoute('app_question_show', [
				'slug' => $question->getSlug()
			]);
    }
}
