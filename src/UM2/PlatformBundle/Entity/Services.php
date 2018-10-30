<?php


namespace UM2\PlatformBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
// N'oubliez pas ce use :
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table("um2_services")
 * @ORM\Entity
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

}

?>