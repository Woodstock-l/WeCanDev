<?php 

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageProfile = "img/default_user.png";

    /**
     * @var ?\Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Tutorial", mappedBy="user")
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $tutorials;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\TutorialFollow", mappedBy="user", orphanRemoval=true)
    */
    private $followedTutorials;


    public function __construct()
    {
        parent::__construct();
        $this->followedTutorials = new ArrayCollection();
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

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

    /**
     * Get the value of imageProfile
     */ 
    public function getImageProfile()
    {
        return $this->imageProfile;
    }

    /**
     * Set the value of imageProfile
     *
     * @return  self
     */ 
    public function setImageProfile($imageProfile)
    {
        $this->imageProfile = $imageProfile;

        return $this;
    }

     /**
     * @return Collection|TutorialFollow[]
     */
     public function getFollowedTutorials(): Collection
     {
         return $this->followedTutorials;
     }
 
     public function addFollowedTutorial(TutorialFollow $followedTutorial): self
     {
         if (!$this->followedTutorials->contains($followedTutorial)) {
             $this->followedTutorials[] = $followedTutorial;
             $followedTutorial->setUser($this);
         }
 
         return $this;
     }
 
     public function removeFollowedTutorial(TutorialFollow $followedTutorial): self
     {
         if ($this->followedTutorials->contains($followedTutorial)) {
             $this->followedTutorials->removeElement($followedTutorial);
             // met le User à null (à moins que ça soit déjà changé)
             if ($followedTutorial->getUser() === $this) {
                 $followedTutorial->setUser(null);
             }
         }
 
         return $this;
     }
}