<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     */
    private $question_next;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollAnswer::class, mappedBy="answer", orphanRemoval=true)
     */
    private $companyPollAnswers;

    public function __construct()
    {
        $this->companyPollAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getQuestionNext(): ?Question
    {
        return $this->question_next;
    }

    public function setQuestionNext(?Question $question_next): self
    {
        $this->question_next = $question_next;

        return $this;
    }

    /**
     * @return Collection|CompanyPollAnswer[]
     */
    public function getCompanyPollAnswers(): Collection
    {
        return $this->companyPollAnswers;
    }

    public function addCompanyPollAnswer(CompanyPollAnswer $companyPollAnswer): self
    {
        if (!$this->companyPollAnswers->contains($companyPollAnswer)) {
            $this->companyPollAnswers[] = $companyPollAnswer;
            $companyPollAnswer->setAnswer($this);
        }

        return $this;
    }

    public function removeCompanyPollAnswer(CompanyPollAnswer $companyPollAnswer): self
    {
        if ($this->companyPollAnswers->removeElement($companyPollAnswer)) {
            // set the owning side to null (unless already changed)
            if ($companyPollAnswer->getAnswer() === $this) {
                $companyPollAnswer->setAnswer(null);
            }
        }

        return $this;
    }
}
