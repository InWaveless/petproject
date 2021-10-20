<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Poll;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FullPollFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        for ($i = 0; $i < 5; $i++) {
            $question = new Question;
            $question->setTitle('Вопрос ' . $i);
            $manager->persist($question);
        }

        $poll = new Poll;
        $poll->setTitle('Опрос №1');
        $poll->setFirstQuestionId($question);
        $manager->persist($poll);

        for ($i = 0; $i < 10; $i++) {
            $answer = new Answer;
            $answer->setType('oneof');
            $answer->setTitle('Ответ ' . $i);
            $answer->setQuestionId($question);
            $manager->persist($answer);
        }
        

        $manager->flush();
    }
}
