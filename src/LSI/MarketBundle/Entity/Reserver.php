<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reserver
 *
 * @ORM\Table(name="reserver")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\ReserverRepository")
 */
class Reserver
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
     * @ORM\ManyToOne(targetEntity="LSI\MarketBundle\Entity\Annonce")
     *@ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="LSI\MarketBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(name="reserve_at", type="datetime")
     *
     */
    private $reserveAt;

    /**
     * @ORM\Column(name="debut", type="date")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $debutPrestation;

    /**
     * @ORM\Column(name="fin", type="date")
     * @Assert\GreaterThanOrEqual("today")
     */
    private $finPrestation;

    /**
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     * @Assert\IdenticalTo("today")
     */
    private $reserveUpdateAt;

    /**
     * @ORM\Column(name="prix_location", type="float", precision=3)
     * @Assert\NotBlank()
     */
    private $prixLocation;

    /**
     * @ORM\Column(name="a_payer", type="float", precision=3)
     * @Assert\NotBlank()
     */
    private $montantReservation;

    /**
     * @ORM\Column(name="budget_restant", type="float", precision=3)
     * @Assert\NotBlank()
     */
    private $budgetRestant;

    /**
     * @ORM\Column(name="assurance", type="boolean")
     * @Assert\NotBlank()
     */
    private $assurance;

    /**
     * @ORM\Column(name="etat", type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 2,
     * )
     */
    private $reserveEtat = 'A';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reserveAt = new \Datetime();
    }

    /**
     * Set reserveAt
     *
     * @param \DateTime $reserveAt
     *
     * @return Reserver
     */
    public function setReserveAt($reserveAt)
    {
        $this->reserveAt = $reserveAt;

        return $this;
    }

    /**
     * Get reserveAt
     *
     * @return \DateTime
     */
    public function getReserveAt()
    {
        return $this->reserveAt;
    }

    /**
     * Set reserveUpdateAt
     *
     * @param \DateTime $reserveUpdateAt
     *
     * @return Reserver
     */
    public function setReserveUpdateAt($reserveUpdateAt)
    {
        $this->reserveUpdateAt = $reserveUpdateAt;

        return $this;
    }

    /**
     * Get reserveUpdateAt
     *
     * @return \DateTime
     */
    public function getReserveUpdateAt()
    {
        return $this->reserveUpdateAt;
    }

    /**
     * Set reserveEtat
     *
     * @param string $reserveEtat
     *
     * @return Reserver
     */
    public function setReserveEtat($reserveEtat)
    {
        $this->reserveEtat = $reserveEtat;

        return $this;
    }

    /**
     * Get reserveEtat
     *
     * @return string
     */
    public function getReserveEtat()
    {
        return $this->reserveEtat;
    }

    /**
     * Set annonce
     *
     * @param \LSI\MarketBundle\Entity\Annonce $annonce
     *
     * @return Reserver
     */
    public function setAnnonce(\LSI\MarketBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \LSI\MarketBundle\Entity\Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
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
     * Set debutPrestation
     *
     * @param \DateTime $debutPrestation
     *
     * @return Reserver
     */
    public function setDebutPrestation($debutPrestation)
    {
        $this->debutPrestation = $debutPrestation;

        return $this;
    }

    /**
     * Get debutPrestation
     *
     * @return \DateTime
     */
    public function getDebutPrestation()
    {
        return $this->debutPrestation;
    }

    /**
     * Set finPrestation
     *
     * @param \DateTime $finPrestation
     *
     * @return Reserver
     */
    public function setFinPrestation($finPrestation)
    {
        $this->finPrestation = $finPrestation;

        return $this;
    }

    /**
     * Get finPrestation
     *
     * @return \DateTime
     */
    public function getFinPrestation()
    {
        return $this->finPrestation;
    }

    /**
     * Set user
     *
     * @param \LSI\MarketBundle\Entity\User $user
     *
     * @return Reserver
     */
    public function setUser(\LSI\MarketBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \LSI\MarketBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

 
    /**
     * Set prixLocation
     *
     * @param float $prixLocation
     *
     * @return Reserver
     */
    public function setPrixLocation($prixLocation)
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }

    /**
     * Get prixLocation
     *
     * @return float
     */
    public function getPrixLocation()
    {
        return $this->prixLocation;
    }

    /**
     * Set montantReservation
     *
     * @param float $montantReservation
     *
     * @return Reserver
     */
    public function setMontantReservation($montantReservation)
    {
        $this->montantReservation = $montantReservation;

        return $this;
    }

    /**
     * Get montantReservation
     *
     * @return float
     */
    public function getMontantReservation()
    {
        return $this->montantReservation;
    }

    /**
     * Set budgetRestant
     *
     * @param float $budgetRestant
     *
     * @return Reserver
     */
    public function setBudgetRestant($budgetRestant)
    {
        $this->budgetRestant = $budgetRestant;

        return $this;
    }

    /**
     * Get budgetRestant
     *
     * @return float
     */
    public function getBudgetRestant()
    {
        return $this->budgetRestant;
    }

    /**
     * Set assurance
     *
     * @param boolean $assurance
     *
     * @return Reserver
     */
    public function setAssurance($assurance)
    {
        $this->assurance = $assurance;

        return $this;
    }

    /**
     * Get assurance
     *
     * @return boolean
     */
    public function getAssurance()
    {
        return $this->assurance;
    }
}
