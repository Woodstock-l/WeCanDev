<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;



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
     * @ORM\Column(type="boolean")
     * @var ?bool
     */
    private $published;

        /**
     * Get the value of published
     *
     * @return  ?bool
     */ 
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set the value of published
     *
     * @param  ?bool  $published
     *
     * @return  self
     */ 
    public function setPublished(?bool $published)
    {
        $this->published = $published;

        return $this;
    }



    /**
     * @ORM\Column(type="boolean")
     * @var ?bool
     */
    private $rating;

        /**
     * Get the value of rating
     *
     * @return  ?bool
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @param  ?bool  $rating
     *
     * @return  self
     */ 
    public function setRating(?bool $rating)
    {
        $this->rating = $rating;

        return $this;
    }



    /**
     * @ORM\Column(type="datetime")
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
}
