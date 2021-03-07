<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class QuestionController extends AbstractController
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var bool
	 */
	private $isDebug;

	/**
	 * QuestionController constructor.
	 * @param LoggerInterface $logger
	 * @param bool $isDebug
	 */
	public function __construct(LoggerInterface $logger, bool $isDebug) {
		$this->logger = $logger;
		$this->isDebug = $isDebug;
	}


	/**
     * @Route("/", name="app_homepage")
     * @param Environment $twigEnvironment
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function homepage(Environment $twigEnvironment): Response
    {
        $html = $twigEnvironment->render('question/homepage.html.twig');
        return new Response($html);
    }

	/**
	 * @Route("/questions/{slug}", name="app_question_show")
	 * @param $slug
	 * @param MarkdownHelper $markdownHelper
	 * @return Response
	 * @throws InvalidArgumentException
	 */
    public function show($slug, MarkdownHelper $markdownHelper): Response
    {
    	if($this->isDebug) $this->logger->info('We are in debug mode!');

        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];
        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';

        $parsedQuestionText = $markdownHelper->parse($questionText);

        return $this->render('question/show.html.twig', [
            'question'      => ucwords(str_replace('-', ' ', $slug)),
            'questionText'  => $parsedQuestionText,
            'answers'       => $answers,
        ]);
    }
}
