<?php

namespace App\Entity;

use App\Repository\CompanyPollRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyPollRepository::class)
 */
class CompanyPoll
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_id;

    /**
     * @ORM\ManyToOne(targetEntity=Poll::class, inversedBy="companyPolls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poll_id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $actual_before;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finished;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $show_after;

    /**
     * @ORM\Column(type="integer")
     */
    private $try_count;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollQuestion::class, mappedBy="company_poll_id", orphanRemoval=true)
     */
    private $companyPollQuestions;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollAnswer::class, mappedBy="company_poll_id", orphanRemoval=true)
     */
    private $companyPollAnswers;

    public function __construct()
    {
        $this->companyPollQuestions = new ArrayCollection();
        $this->companyPollAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyId(): ?int
    {
        return $this->company_id;
    }

    public function setCompanyId(int $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
    }

    public function getPollId(): ?Poll
    {
        return $this->poll_id;
    }

    public function setPollId(?Poll $poll_id): self
    {
        $this->poll_id = $poll_id;

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

    public function getActualBefore(): ?\DateTimeImmutable
    {
        return $this->actual_before;
    }

    public function setActualBefore(\DateTimeImmutable $actual_before): self
    {
        $this->actual_before = $actual_before;

        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }

    public function getShowAfter(): ?\DateTimeImmutable
    {
        return $this->show_after;
    }

    public function setShowAfter(\DateTimeImmutable $show_after): self
    {
        $this->show_after = $show_after;

        return $this;
    }

    public function getTryCount(): ?int
    {
        return $this->try_count;
    }

    public function setTryCount(int $try_count): self
    {
        $this->try_count = $try_count;

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
            $companyPollQuestion->setCompanyPollId($this);
        }

        return $this;
    }

    public function removeCompanyPollQuestion(CompanyPollQuestion $companyPollQuestion): self
    {
        if ($this->companyPollQuestions->removeElement($companyPollQuestion)) {
            // set the owning side to null (unless already changed)
            if ($companyPollQuestion->getCompanyPollId() === $this) {
                $companyPollQuestion->setCompanyPollId(null);
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
            $companyPollAnswer->setCompanyPollId($this);
        }

        return $this;
    }

    public function removeCompanyPollAnswer(CompanyPollAnswer $companyPollAnswer): self
    {
        if ($this->companyPollAnswers->removeElement($companyPollAnswer)) {
            // set the owning side to null (unless already changed)
            if ($companyPollAnswer->getCompanyPollId() === $this) {
                $companyPollAnswer->setCompanyPollId(null);
            }
        }

        return $this;
    }
}
