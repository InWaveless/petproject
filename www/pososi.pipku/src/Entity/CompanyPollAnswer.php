<?php

namespace App\Entity;

use App\Repository\CompanyPollAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyPollAnswerRepository::class)
 */
class CompanyPollAnswer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyPoll::class, inversedBy="companyPollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company_poll_id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="companyPollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question_id;

    /**
     * @ORM\ManyToOne(targetEntity=Answer::class, inversedBy="companyPollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer_id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $meta = [];

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyPollId(): ?CompanyPoll
    {
        return $this->company_poll_id;
    }

    public function setCompanyPollId(?CompanyPoll $company_poll_id): self
    {
        $this->company_poll_id = $company_poll_id;

        return $this;
    }

    public function getQuestionId(): ?Question
    {
        return $this->question_id;
    }

    public function setQuestionId(?Question $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getAnswerId(): ?Answer
    {
        return $this->answer_id;
    }

    public function setAnswerId(?Answer $answer_id): self
    {
        $this->answer_id = $answer_id;

        return $this;
    }

    public function getMeta(): ?array
    {
        return $this->meta;
    }

    public function setMeta(?array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
