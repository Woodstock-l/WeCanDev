<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(
     *      min = 2,
     *      max = 60
     * )
     * @Assert\NotBlank(message="validator.notblank")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tutorial", mappedBy="categories")
     * @var ?\Doctrine\Common\Collections\ArrayCollection
     */
    private $tutorials;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get min = 2,
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set min = 2,
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of tutorials
     *
     * @return  ?\Doctrine\Common\Collections\ArrayCollection
     */ 
    public function getTutorials()
    {
        return $this->tutorials;
    }

    /**
     * Set the value of tutorials
     *
     * @param  ?\Doctrine\Common\Collections\ArrayCollection  $tutorials
     *
     * @return  self
     */ 
    public function setTutorials(?\Doctrine\Common\Collections\ArrayCollection $tutorials)
    {
        $this->tutorials = $tutorials;

        return $this;
    }
}
