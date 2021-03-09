<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
	    $question = new Question();
	    $question->setName('Missing pants')
		    ->setSlug('missing-pants-'.rand(0, 1000))
		    ->setQuestion('Hi, I\'m having a *weird* day. Does anyone have a spell to call your pants back?');

	    if(rand(1, 10) > 2) {
		    $question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
	    }

	    $question->setVotes(rand(-20, 50));

	    $manager->persist($question);
      $manager->flush();
    }
}
