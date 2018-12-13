<?php
// src/UserBundle/Entity/User.php
//auteur : Khang NGUYEN - Licence 3 
namespace UM2\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @ORM\Table(name="um2_user")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\Length(min=6, minMessage="Votre mot de passe doit faire minimum 6 caractères.")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Vous n'avez pas tapé la même mot de passe")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tapé la même mot de passe")
     */
    public $confirm_password;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=250)
     */
    private $adresse;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     *
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="datetime")
     */
    private $dateNaissance;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     * @Assert\NotBlank(message="Veillez saisir un numéro valide !")
     * @Assert\Regex("^(33|0)(6|7|9)\d{8}$^")
     */
    private $telephone;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="isNonLocked", type="boolean")
     */
    private $isNonLocked;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="estTropConsomme", type="boolean")
     */
    private $estTropConsomme;

    /**
     *
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="dateActive", type="datetime")
     *
     */
    private $dateActive;


    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="cagnote", type="integer");
     *
     */
    private $cagnote = 0;

    public function __construct()
    {   $this->isNonLocked = true;
        $this->isActive = true;
        $this->estTropConsomme = false;
        $this->roles = array('ROLE_USER');
        $this->dateActive = new \DateTime();
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
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
     * Get pseudo
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function eraseCredentials(){}

    public function getSalt(){}

    public function getRoles()
    {
        return['ROLE_USER'];
    }

    /**
     * Set estActive
     *
     * @param boolean $estActive
     *
     * @return User
     */
    public function setIsActive($estActive)
    {
        $this->isActive = $estActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set cagnote
     *
     * @param integer $cagnote
     *
     * @return User
     */
    public function setCagnote()
    {
        $this->cagnote = $this->cagnote + 1;

        return $this;
    }

    /**
     * Get cagnote
     *
     * @return integer
     */
    public function getCagnote()
    {
        return $this->cagnote;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set dateActive
     *
     * @param \DateTime $dateActive
     *
     * @return User
     */
    public function setDateActive($dateActive)
    {
        $this->dateActive = $dateActive;

        return $this;
    }

    /**
     * Get dateActive
     *
     * @return \DateTime
     */
    public function getDateActive()
    {
        return $this->dateActive;
    }

    public function isAccountNonExpired()
    {
        return false;
    }

    public function isAccountNonLocked()
    {
        return false;
    }

    public function isCredentialsNonExpired()
    {
        return false;
    }

    // serialize and unserialize must be updated - see below
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->adresse,
            $this->ville,
            $this->dateNaissance,
            $this->telephone,
            $this->isNonLocked,
            $this->isActive,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            $this->adresse,
            $this->ville,
            $this->dateNaissance,
            $this->telephone,
            $this->isNonLocked,
            $this->isActive,
        ) = unserialize($serialized);
    }


    /**
     * Set isNonLocked
     *
     * @param boolean $isNonLocked
     *
     * @return User
     */
    public function setIsNonLocked($isNonLocked)
    {
        $this->isNonLocked = $isNonLocked;

        return $this;
    }

    /**
     * Get isNonLocked
     *
     * @return boolean
     */
    public function getIsNonLocked()
    {
        return $this->isNonLocked;
    }

    /**
     * Set estTropConsomme
     *
     * @param boolean $estTropConsomme
     *
     * @return User
     */
    public function setEstTropConsomme($estTropConsomme)
    {
        $this->estTropConsomme = $estTropConsomme;

        return $this;
    }

    /**
     * Get estTropConsomme
     *
     * @return boolean
     */
    public function getEstTropConsomme()
    {
        return $this->estTropConsomme;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
