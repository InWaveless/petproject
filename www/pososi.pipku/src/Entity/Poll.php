<?php

namespace App\Entity;

use App\Repository\PollRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PollRepository::class)
 */
class Poll
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
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="polls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $first_question_id;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPoll::class, mappedBy="poll_id", orphanRemoval=true)
     */
    private $companyPolls;

    public function __construct()
    {
        $this->companyPolls = new ArrayCollection();
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

    public function getFirstQuestionId(): ?Question
    {
        return $this->first_question_id;
    }

    public function setFirstQuestionId(?Question $first_question_id): self
    {
        $this->first_question_id = $first_question_id;

        return $this;
    }

    /**
     * @return Collection|CompanyPoll[]
     */
    public function getCompanyPolls(): Collection
    {
        return $this->companyPolls;
    }

    public function addCompanyPoll(CompanyPoll $companyPoll): self
    {
        if (!$this->companyPolls->contains($companyPoll)) {
            $this->companyPolls[] = $companyPoll;
            $companyPoll->setPollId($this);
        }

        return $this;
    }

    public function removeCompanyPoll(CompanyPoll $companyPoll): self
    {
        if ($this->companyPolls->removeElement($companyPoll)) {
            // set the owning side to null (unless already changed)
            if ($companyPoll->getPollId() === $this) {
                $companyPoll->setPollId(null);
            }
        }

        return $this;
    }
}
