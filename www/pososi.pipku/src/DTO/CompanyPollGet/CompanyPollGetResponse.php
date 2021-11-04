<?php
declare(strict_types=1);
namespace App\DTO\CompanyPollGet;

use App\DTO\Question;
use App\DTO\Answer;
use Doctrine\Common\Collections\Collection;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class CompanyPollGetResponse
{
    public Question $question;

    /** 
     * @OA\Property(
     *   type="array",
     *   @OA\Items(ref=@Model(type=Answer::class))
     * )
     */
    public Collection $answers;

    public function getAnswers(): array
    {
        foreach ($this->answers as $answer) {
            $result[] = ['id' => $answer->getId(), 'title' => $answer->getTitle(), 'type' => $answer->getType()];
        }
        return $result;
    }
}