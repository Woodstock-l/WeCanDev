<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
 */
class Tutorial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string
     */
    private $content;

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"all"}, orphanRemoval=true)
     * @var ?\App\Entity\Image
     */
    private $image;

    /**
     * Get the value of image
     *
     * @return  ?\App\Entity\Image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  ?\App\Entity\Image  $image
     *
     * @return  self
     */ 
    public function setImage(?\App\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @var ?\App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tutorials")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $user;

        /**
     * Get the value of user
     *
     * @return  ?\App\Entity\User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  ?\App\Entity\User  $user
     *
     * @return  self
     */ 
    public function setUser(?\App\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="tutorials")
     * @Assert\NotBlank()
     * @var ?\Doctrine\Common\Collections\ArrayCollection
     */
    private $categories;

    /**
     * Get the value of categories
     *
     * @return  ?\Doctrine\Common\Collections\ArrayCollection
     */ 
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set the value of categories
     *
     * @param  ?\Doctrine\Common\Collections\ArrayCollection  $categories
     *
     * @return  self
     */ 
    public function setCategories(?\Doctrine\Common\Collections\ArrayCollection $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @var bool
     */
    private $published;

    /**
     * Get the value of published
     *
     * @return  bool
     */ 
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set the value of published
     *
     * @param  bool  $published
     *
     * @return  self
     */ 
    public function setPublished(bool $published)
    {
        $this->published = $published;

        return $this;
    }

    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var ?\DateTime
     */
    private $dateCreate;

        /**
     * Get the value of dateCreate
     *
     * @return  ?\DateTime
     */ 
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set the value of dateCreate
     *
     * @param  ?\DateTime  $dateCreate
     *
     * @return  self
     */ 
    public function setDateCreate(?\DateTime $dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var ?\DateTime
     */
    private $dateUpdate;

       /**
     * Get the value of dateUpdate
     *
     * @return  ?\DateTime
     */ 
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set the value of dateUpdate
     *
     * @param  ?\DateTime  $dateUpdate
     *
     * @return  self
     */ 
    public function setDateUpdate(?\DateTime $dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="tutorial", orphanRemoval=true)
     */
    private $userRate;

    /**
     * @return Collection|Rating[]
    */
    public function getUserRate(): Collection
    {
        return $this->userRate;
    }

    public function addRate(Rating $userRate): self
    {
        if (!$this->userRates->contains($userRate)) {
        $this->userRates[] = $userRate;
            $userRate->setTutorials($this);
        }

        return $this;
    }

    public function removeRate(Rating $userRate): self
    {
        if ($this->userRates->contains($userRate)) {
            $this->userRates->removeElement($userRate);
            // set the owning side to null (unless already changed)
            if ($userRate->getTutorials() === $this) {
                $userRate->setTutorials(null);
            }
        }

        return $this;
    }
    /*
     * @ORM\OneToMany(targetEntity="App\Entity\TutorialFollow", mappedBy="tutorial", orphanRemoval=true)
     */
     private $followers;

    /**
     * @return Collection|TutorialFollow[]
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }
 
    public function addFollower(TutorialFollow $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->setTutorial($this);
        }
 
        return $this;
    }
 
    public function removeFollower(TutorialFollow $follower): self
    {
        if ($this->followers->contains($follower)) {
            $this->followers->removeElement($follower);
            // set the owning side to null (unless already changed)
            if ($follower->getTutorial() === $this) {
                $follower->setTutorial(null);
            }
        }
 
        return $this;
    }


    public function __construct()
    {
        $this->dateCreate = new \DateTime;
        $this->dateUpdate = null;
        $this->followers = new ArrayCollection();
    }
}
