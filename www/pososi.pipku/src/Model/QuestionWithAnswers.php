<?php
declare(strict_types=1);
namespace App\Model;

use App\Entity\Question;
use Doctrine\Common\Collections\Collection;

class QuestionWithAnswers
{
    public Question $question;

    public Collection $answers;

    public function getQuestion(): array
    {
        return [
            'id' => $this->question->getId(),
            'title' => $this->question->getTitle()
        ];
    }

    public function getAnswers(): array
    {
        foreach ($this->answers as $answer) {
            $result[] = ['id' => $answer->getId(), 'title' => $answer->getTitle(), 'type' => $answer->getType()];
        }
        return $result;
    }
}