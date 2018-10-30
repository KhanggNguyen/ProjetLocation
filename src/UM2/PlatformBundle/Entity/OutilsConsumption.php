<?php 
// src/PlatformBundle/Entity/Outils.php

namespace UM2\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Outils_consumption")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\OutilsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OutilsConsumption
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="UM2\PlatformBundle\Entity\Outils", cascade={"persist"})
	 * JoinColumn(nullable=false)
	 */
	private $outil;

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
      * @ORM\Column(name="date", type="datetime", unique=true)
      * @Assert\DateTime()
      */
    private $date;

    public function __construct()
    {
    	
    }

    /**
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
     * @return OutilsConsumption
     */
    public function setDate($date)
    {
        $this->date = $date;

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
     * Set Outil
     *
     * @param \UM2\PlatformBundle\Entity\Outils $Outil
     *
     * @return OutilsConsumption
     */
    public function setOutil(\UM2\PlatformBundle\Entity\Outils $Outil = null)
    {
        $this->Outil = $Outil;

        return $this;
    }

    /**
     * Get Outil
     *
     * @return \UM2\PlatformBundle\Entity\Outils
     */
    public function getOutil()
    {
        return $this->Outil;
    }

    /**
     * Set user
     *
     * @param \UM2\UserBundle\Entity\User $user
     *
     * @return OutilsConsumption
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
