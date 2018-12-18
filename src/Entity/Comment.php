<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\ManyToOne("App\Entity\User")
    */
    private $user;

    /**
    * @ORM\Column(type="text")
    * @var string
    */
    private $content;

    /**
    * @ORM\Column(type="datetime", nullable=true)
    * @var ?\DateTime
    */
    private $createdAt;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Tutorial", inversedBy="comments")
    * @ORM\JoinColumn(nullable=false)
    */
    private $tutorial;



    public function getId(): ?int
    {
        return $this->id;
    }

    
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
     * Get the value of createdAt
     *
     * @return  ?\DateTime
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  ?\DateTime  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(?\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

   
    /**
     * Get the value of tutorial
     */ 
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * Set the value of tutorial
     *
     * @return  self
     */ 
    public function setTutorial($tutorial)
    {
        $this->tutorial = $tutorial;

        return $this;
    }
}
