<?php 
// src/PlatformBundle/Entity/Outils.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Services_Taxonomie")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\ServicesTaxonomieRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServicesTaxonomie
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
     * @ORM\ManyToOne(targetEntity="UM2\PlatformBundle\Entity\Services", cascade={"persist"})
  	 * @ORM\JoinColumn(nullable=false)
  	 *
  	 */
    private $service;

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
     * Set service
     *
     * @param \UM2\PlatformBundle\Entity\Services $service
     *
     * @return ServicesTaxonomie
     */
    public function setService(\UM2\PlatformBundle\Entity\Services $service)
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
     * Set motcle
     *
     * @param \UM2\PlatformBundle\Entity\Taxonomie $motcle
     *
     * @return ServicesTaxonomie
     */
    public function setMotcle(\UM2\PlatformBundle\Entity\Taxonomie $motcle)
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * Get motcle
     *
     * @return \UM2\PlatformBundle\Entity\Taxonomie
     */
    public function getMotcle()
    {
        return $this->motcle;
    }
}
