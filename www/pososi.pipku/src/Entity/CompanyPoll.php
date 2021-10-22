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
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Poll::class, inversedBy="companyPolls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poll;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $actualBefore;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finished;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $showAfter;

    /**
     * @ORM\Column(type="integer")
     */
    private $tryCount;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollQuestion::class, mappedBy="company_poll", orphanRemoval=true)
     */
    private $companyPollQuestions;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPollAnswer::class, mappedBy="company_poll", orphanRemoval=true)
     */
    private $companyPollAnswers;

    public function __construct()
    {
        $this->companyPollQuestions = new ArrayCollection();
        $this->companyPollAnswers = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(?Poll $poll): self
    {
        $this->poll = $poll;

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

    public function getActualBefore(): ?\DateTimeImmutable
    {
        return $this->actualBefore;
    }

    public function setActualBefore(\DateTimeImmutable $actualBefore): self
    {
        $this->actualBefore = $actualBefore;

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
        return $this->showAfter;
    }

    public function setShowAfter(\DateTimeImmutable $showAfter): self
    {
        $this->showAfter = $showAfter;

        return $this;
    }

    public function getTryCount(): ?int
    {
        return $this->tryCount;
    }

    public function setTryCount(int $tryCount): self
    {
        $this->tryCount = $tryCount;

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
            $companyPollQuestion->setCompanyPoll($this);
        }

        return $this;
    }

    public function removeCompanyPollQuestion(CompanyPollQuestion $companyPollQuestion): self
    {
        if ($this->companyPollQuestions->removeElement($companyPollQuestion)) {
            // set the owning side to null (unless already changed)
            if ($companyPollQuestion->getCompanyPoll() === $this) {
                $companyPollQuestion->setCompanyPoll(null);
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
            $companyPollAnswer->setCompanyPoll($this);
        }

        return $this;
    }

    public function removeCompanyPollAnswer(CompanyPollAnswer $companyPollAnswer): self
    {
        if ($this->companyPollAnswers->removeElement($companyPollAnswer)) {
            // set the owning side to null (unless already changed)
            if ($companyPollAnswer->getCompanyPoll() === $this) {
                $companyPollAnswer->setCompanyPoll(null);
            }
        }

        return $this;
    }
}
