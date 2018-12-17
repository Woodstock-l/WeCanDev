<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialFollowRepository")
 */
class TutorialFollow
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;

    /**
    * @ORM\Column(type="datetime")
    */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Tutorial", inversedBy="followers")
    * @ORM\JoinColumn(nullable=false)
    */
    private $tutorial;
 
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="followedTutorials")
    * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTutorial(): ?Tutorial
    {
        return $this->tutorial;
    }

    public function setTutorial(?Tutorial $tutorial): self
    {
        $this->tutorial = $tutorial;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __construct()
    {
        $this->date = new \DateTime;
    }
}
