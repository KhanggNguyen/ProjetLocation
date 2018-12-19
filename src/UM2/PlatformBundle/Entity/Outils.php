<?php 
// src/PlatformBundle/Entity/Outils.php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN
namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_Outils")
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\OutilsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Outils
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
      * @ORM\Column(name="titre", type="string", length=100, unique=true)
      * @Assert\Length(min=10)
      */
    private $titre;

    /**
	  *
	  * @var float
	  *
	  * @ORM\Column(name="prixNeuf", type="float")
      * @Assert\Notblank()
	  */
    private $prixNeuf;

    /**
      *
      * @var \DateTime
      * 
      * @ORM\Column(name="date", type="datetime")
      * @Assert\DateTime()
      */
    private $date;

    /**
      *
      * @var string
      *
      * @ORM\Column(name="lieu", type="string", length=50)
      * @Assert\Length(min=4)
      */
    private $lieu;

    /**
      *
      * @var boolean
      *
      * @ORM\Column(name="garantie", type="boolean")
      */
    private $garantie;

    /**
      *
      * @ORM\OneToOne(targetEntity="UM2\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
      * @ORM\JoinColumn(nullable=false)
      * @Assert\Valid()
      */
    private $image;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UM2\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendeur;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="estDispo", type="boolean")
     */
    private $estDispo;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->estDispo = true;
        $this->active = true;
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Outils
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set prixNeuf
     *
     * @param float $prixNeuf
     *
     * @return Outils
     */
    public function setPrixNeuf($prixNeuf)
    {
        $this->prixNeuf = $prixNeuf;

        return $this;
    }

    /**
     * Get prixNeuf
     *
     * @return float
     */
    public function getPrixNeuf()
    {
        return $this->prixNeuf;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Outils
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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Outils
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set garantie
     *
     * @param boolean $garantie
     *
     * @return Outils
     */
    public function setGarantie($garantie)
    {
        $this->garantie = $garantie;

        return $this;
    }

    /**
     * Get garantie
     *
     * @return boolean
     */
    public function getGarantie()
    {
        return $this->garantie;
    }

    /**
     * Set image
     *
     * @param \UM2\PlatformBundle\Entity\Image $image
     *
     * @return Outils
     */
    public function setImage(\UM2\PlatformBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \UM2\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set vendeur
     *
     * @param \UM2\UserBundle\Entity\User $vendeur
     *
     * @return Outils
     */
    public function setVendeur(\UM2\UserBundle\Entity\User $vendeur)
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * Get vendeur
     *
     * @return \UM2\UserBundle\Entity\User
     */
    public function getVendeur()
    {
        return $this->vendeur;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Outils
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set estDispo
     *
     * @param boolean $estDispo
     *
     * @return Outils
     */
    public function setEstDispo($estDispo)
    {
        $this->estDispo = $estDispo;

        return $this;
    }

    /**
     * Get estDispo
     *
     * @return boolean
     */
    public function getEstDispo()
    {
        return $this->estDispo;
    }
}
