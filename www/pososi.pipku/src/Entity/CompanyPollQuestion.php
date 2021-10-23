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
     * @ORM\ManyToOne(targetEntity=CompanyPoll::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $companyPoll;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     */
    private $question;

    /**
     * @ORM\Column(type="boolean")
     */
    private $answered;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyPoll(): ?CompanyPoll
    {
        return $this->companyPoll;
    }

    public function setCompanyPoll(?CompanyPoll $companyPoll): self
    {
        $this->companyPoll = $companyPoll;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
