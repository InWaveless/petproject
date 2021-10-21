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
    private $first_question;

    /**
     * @ORM\OneToMany(targetEntity=CompanyPoll::class, mappedBy="poll", orphanRemoval=true)
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

    public function getFirstQuestion(): ?Question
    {
        return $this->first_question;
    }

    public function setFirstQuestion(?Question $first_question): self
    {
        $this->first_question = $first_question;

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
            $companyPoll->setPoll($this);
        }

        return $this;
    }

    public function removeCompanyPoll(CompanyPoll $companyPoll): self
    {
        if ($this->companyPolls->removeElement($companyPoll)) {
            // set the owning side to null (unless already changed)
            if ($companyPoll->getPoll() === $this) {
                $companyPoll->setPoll(null);
            }
        }

        return $this;
    }
}
