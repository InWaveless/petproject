<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Poll::class, mappedBy="first_question", orphanRemoval=true)
     */
    private $polls;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question", orphanRemoval=true)
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollQuestion::class, mappedBy="question")
     */
    private $companyPollQuestions;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollAnswer::class, mappedBy="question", orphanRemoval=true)
     */
    private $companyPollAnswers;

    public function __construct()
    {
        $this->polls = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->companyPollQuestions = new ArrayCollection();
        $this->companyPollAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Poll[]
     */
    public function getPolls(): Collection
    {
        return $this->polls;
    }

    public function addPoll(Poll $poll): self
    {
        if (!$this->polls->contains($poll)) {
            $this->polls[] = $poll;
            $poll->setFirstQuestion($this);
        }

        return $this;
    }

    public function removePoll(Poll $poll): self
    {
        if ($this->polls->removeElement($poll)) {
            // set the owning side to null (unless already changed)
            if ($poll->getFirstQuestion() === $this) {
                $poll->setFirstQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompanyPollQuestion[]
     */
    public function getCompanyPollQuestions(): Collection
    {
        return $this->companyPollQuestions;
    }

    public function addCompanyPollQuestion(CompanyPollQuestion $companyPollQuestion): self
    {
        if (!$this->companyPollQuestions->contains($companyPollQuestion)) {
            $this->companyPollQuestions[] = $companyPollQuestion;
            $companyPollQuestion->setQuestion($this);
        }

        return $this;
    }

    public function removeCompanyPollQuestion(CompanyPollQuestion $companyPollQuestion): self
    {
        if ($this->companyPollQuestions->removeElement($companyPollQuestion)) {
            // set the owning side to null (unless already changed)
            if ($companyPollQuestion->getQuestion() === $this) {
                $companyPollQuestion->setQuestion(null);
            }
        }

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
            $companyPollAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeCompanyPollAnswer(CompanyPollAnswer $companyPollAnswer): self
    {
        if ($this->companyPollAnswers->removeElement($companyPollAnswer)) {
            // set the owning side to null (unless already changed)
            if ($companyPollAnswer->getQuestion() === $this) {
                $companyPollAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
