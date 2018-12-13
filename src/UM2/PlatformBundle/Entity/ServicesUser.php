<?php 
// src/PlatformBundle/Entity/ServicesUser.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table("um2_Services_User")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\ServicesUserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServicesUser
{
	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\OneToOne(targetEntity="PlagesHoraire", cascade={"persist"})
     *
     */
    private $horaire;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Services", cascade={"persist"})
     * JoinColumn(nullable=false)
	 */
    private $service;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UM2\UserBundle\Entity\User", cascade={"persist"})
     * JoinColumn(nullable=false)
     */
    private $user;


    /**
      *
      * @var \DateTime
      * 
      * @ORM\Column(name="date", type="datetime")
      * @Assert\DateTime()
      */
    private $date;

    public function __construct()
    {
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ServicesUser
     */
    public function setDate()
    {
        $this->date = new \DateTime();

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set horaire
     *
     * @param \UM2\PlatformBundle\Entity\PlagesHoraire $horaire
     *
     * @return ServicesUser
     */
    public function setHoraire(\UM2\PlatformBundle\Entity\PlagesHoraire $horaire = null)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return \UM2\PlatformBundle\Entity\PlagesHoraire
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * Set service
     *
     * @param \UM2\PlatformBundle\Entity\Services $service
     *
     * @return ServicesUser
     */
    public function setService(\UM2\PlatformBundle\Entity\Services $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \UM2\PlatformBundle\Entity\Services
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set user
     *
     * @param \UM2\UserBundle\Entity\User $user
     *
     * @return ServicesUser
     */
    public function setUser(\UM2\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UM2\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
