<?php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN

namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table("um2_services")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="UM2\PlatformBundle\Repository\ServicesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Services
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
	 * @ORM\Column(name="titre", type="string")
	 */
    private $titre;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * 
     * @var String
     *
     * @ORM\Column(name="descriptif", type="string")
     */
    private $descriptif;

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
      * @ORM\Column(name="lieu", type="string")
      */
    private $lieu;

    /**
      *
      * @ORM\OneToMany(targetEntity="PlagesHoraire", mappedBy="service")
      * @ORM\JoinColumn(nullable=false)
      */
    private $plageshoraire;

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
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    public function __construct()
    {
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
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Services
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Services
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
     * Set vendeur
     *
     * @param \UM2\UserBundle\Entity\User $vendeur
     *
     * @return Services
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Services
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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Services
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
     * Set prix
     *
     * @param integer $prix
     *
     * @return Services
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    


    /**
     * Add plageshoraire
     *
     * @param \UM2\PlatformBundle\Entity\PlagesHoraire $plageshoraire
     *
     * @return Services
     */
    public function addPlageshoraire(\UM2\PlatformBundle\Entity\PlagesHoraire $plageshoraire)
    {
        $this->plageshoraire[] = $plageshoraire;

        return $this;
    }

    /**
     * Remove plageshoraire
     *
     * @param \UM2\PlatformBundle\Entity\PlagesHoraire $plageshoraire
     */
    public function removePlageshoraire(\UM2\PlatformBundle\Entity\PlagesHoraire $plageshoraire)
    {
        $this->plageshoraire->removeElement($plageshoraire);
    }

    /**
     * Get plageshoraire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlageshoraire()
    {
        return $this->plageshoraire;
    }

}
