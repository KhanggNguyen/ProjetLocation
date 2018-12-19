<?php 
// src/PlatformBundle/Entity/Outils.php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN
namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Outils_Taxonomie")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\OutilsTaxonomieRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OutilsTaxonomie
{
	/**
      * @var int
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UM2\PlatformBundle\Entity\Outils", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 *
	 */
    private $outil;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UM2\PlatformBundle\Entity\Taxonomie", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 *
	 */
    private $motcle;

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
     * Set outil
     *
     * @param \UM2\PlatformBundle\Entity\Outils $outil
     *
     * @return OutilsTaxonomie
     */
    public function setOutil(\UM2\PlatformBundle\Entity\Outils $outil)
    {
        $this->outil = $outil;

        return $this;
    }

    /**
     * Get outil
     *
     * @return \UM2\PlatformBundle\Entity\Outils
     */
    public function getOutil()
    {
        return $this->outil;
    }

    /**
     * Set motcle
     *
     * @param \UM2\PlatformBundle\Entity\Taxonomie $motcle
     *
     * @return OutilsTaxonomie
     */
    public function setMotcle(\UM2\PlatformBundle\Entity\Taxonomie $motcle)
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * Get motcle
     *
     * @return \UM2\PlatformBundle\Entity\Outils
     */
    public function getMotcle()
    {
        return $this->motcle;
    }
}
