<?php 
// src/PlatformBundle/Entity/Taxonomie.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Taxonomie")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\TaxonomieRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Taxonomie
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
     * @var string
     *
     * @ORM\Column(name="motcle", type="string")
     */
    private $motcle;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;


    public function __construct(){
    	
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
     * Set motcle
     *
     * @param string $motcle
     *
     * @return Taxonomie
     */
    public function setMotcle($motcle)
    {
        $this->motcle = $motcle;

        return $this;
    }

    /**
     * Get motcle
     *
     * @return string
     */
    public function getMotcle()
    {
        return $this->motcle;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Taxonomie
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
