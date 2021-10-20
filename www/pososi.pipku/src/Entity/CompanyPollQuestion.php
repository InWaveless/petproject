<?php

namespace App\Entity;

use App\Repository\CompanyPollQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyPollQuestionRepository::class)
 */
class CompanyPollQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyPoll::class, inversedBy="companyPollQuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company_poll_id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="companyPollQuestions")
     */
    private $question_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $answered;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

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

    public function getAnswered(): ?bool
    {
        return $this->answered;
    }

    public function setAnswered(bool $answered): self
    {
        $this->answered = $answered;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
