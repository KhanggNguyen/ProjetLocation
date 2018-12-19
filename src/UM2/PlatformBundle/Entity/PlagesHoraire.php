<?php 
// src/PlatformBundle/Entity/PlagesHoraire.php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN
namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table("um2_plageshoraire")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PlagesHoraire
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateService", type="datetime")
     */
    private $dateService;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heuredebut", type="time")
     */
    private $heuredebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurefin", type="time")
     */
    private $heurefin;

    /**
     * @ORM\ManyToOne(targetEntity="Services", inversedBy="plageshoraire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
      *
      * @var boolean
      *
      * @ORM\Column(name="estLoue", type="boolean")
      */
    private $estLoue;

    public function __construct()
    {
        $this->estLoue = false;
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
     * Set heuredebut
     *
     * @param array $heuredebut
     *
     * @return PlagesHoraire
     */
    public function setHeuredebut($heuredebut)
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    /**
     * Get heuredebut
     *
     * @return array
     */
    public function getHeuredebut()
    {
        return $this->heuredebut;
    }

    /**
     * Set heurefin
     *
     * @param array $heurefin
     *
     * @return PlagesHoraire
     */
    public function setHeurefin($heurefin)
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    /**
     * Get heurefin
     *
     * @return array
     */
    public function getHeurefin()
    {
        return $this->heurefin;
    }

    /**
     * Set service
     *
     * @param \UM2\PlatformBundle\Entity\Services $service
     *
     * @return PlagesHoraire
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
     * Set dateService
     *
     * @param \DateTime $dateService
     *
     * @return PlagesHoraire
     */
    public function setDateService($dateService)
    {
        $this->dateService = $dateService;

        return $this;
    }

    /**
     * Get dateService
     *
     * @return \DateTime
     */
    public function getDateService()
    {
        return $this->dateService;
    }

    /**
     * Set estLoue
     *
     * @param boolean $estLoue
     *
     * @return PlagesHoraire
     */
    public function setEstLoue($estLoue)
    {
        $this->estLoue = $estLoue;

        return $this;
    }

    /**
     * Get estLoue
     *
     * @return boolean
     */
    public function getEstLoue()
    {
        return $this->estLoue;
    }
}
