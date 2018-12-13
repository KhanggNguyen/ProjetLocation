<?php 
// src/PlatformBundle/Entity/Outils.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Outils_User")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\OutilsUserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OutilsUser
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
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $outil;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="UM2\UserBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $user;

	/**
      *
      * @var \DateTime
      * 
      * @ORM\Column(name="date", type="date")
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
     * @return OutilsUser
     */
    public function setDate($d)
    {
        $this->date = $d;

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
     * @return OutilsUser
     */
    public function setOutil(\UM2\PlatformBundle\Entity\Outils $Outil)
    {
        $this->outil = $Outil;

        return $this;
    }

    /**
     * Get Outil
     *
     * @return \UM2\PlatformBundle\Entity\Outils
     */
    public function getOutil()
    {
        return $this->outil;
    }

    /**
     * Set user
     *
     * @param \UM2\UserBundle\Entity\User $user
     *
     * @return OutilsUser
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
