<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AnnoncePrix
 *
 * @ORM\Table(name="annonce_prix")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\AnnoncePrixRepository")
 */
class AnnoncePrix
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
     * @ORM\Column(name="datedebut1", type="date")
     */
    private $datedebut1;

    /**
     *
     * @ORM\Column(name="datefin1", type="date")
     */
    private $datefin1;

    /**
     * @var string
     *
     * @ORM\Column(name="prix1", type="string", length=255, nullable= true)
     * 
     */
    private $prix1;

    /**
     * @ORM\ManyToOne(targetEntity="LSI\MarketBundle\Entity\Annonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToMany(targetEntity="LSI\MarketBundle\Entity\PublicMairie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $mairies;

    /**
     * @ORM\ManyToMany(targetEntity="LSI\MarketBundle\Entity\PublicAdministre", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $administres;

    /**
     *
     * @ORM\Column(name="datedebut2", type="date")
     */
    private $datedebut2;

    /**
     *
     * @ORM\Column(name="datefin2", type="date")
     */
    private $datefin2;

    /**
     * @var string
     *
     * @ORM\Column(name="prix2", type="string", length=255, nullable= true)
     * 
     */
    private $prix2;

    /**
     *
     * @ORM\Column(name="datedebut3", type="date")
     */
    private $datedebut3;

    /**
     *
     * @ORM\Column(name="datefin3", type="date")
     */
    private $datefin3;

    /**
     * @var string
     *
     * @ORM\Column(name="prix3", type="string", length=255, nullable= true)
     * 
     */
    private $prix3;

    /**
     *
     * @ORM\Column(name="datedebut4", type="date")
     */
    private $datedebut4;

    /**
     *
     * @ORM\Column(name="datefin4", type="date")
     */
    private $datefin4;

    /**
     * @var string
     *
     * @ORM\Column(name="prix4", type="string", length=255, nullable= true)
     * 
     */
    private $prix4;

    /**
     *
     * @ORM\Column(name="datedebut5", type="date")
     */
    private $datedebut5;

    /**
     *
     * @ORM\Column(name="datefin5", type="date")
     */
    private $datefin5;

    /**
     * @var string
     *
     * @ORM\Column(name="prix5", type="string", length=255, nullable= true)
     * 
     */
    private $prix5;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mairies = new ArrayCollection;
        $this->administres = new ArrayCollection;
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
     * Set datedebut1
     *
     * @param \DateTime $datedebut1
     *
     * @return AnnoncePrix
     */
    public function setDatedebut1($datedebut1)
    {
        $this->datedebut1 = $datedebut1;

        return $this;
    }

    /**
     * Get datedebut1
     *
     * @return \DateTime
     */
    public function getDatedebut1()
    {
        return $this->datedebut1;
    }

    /**
     * Set datefin1
     *
     * @param \DateTime $datefin1
     *
     * @return AnnoncePrix
     */
    public function setDatefin1($datefin1)
    {
        $this->datefin1 = $datefin1;

        return $this;
    }

    /**
     * Get datefin1
     *
     * @return \DateTime
     */
    public function getDatefin1()
    {
        return $this->datefin1;
    }

    /**
     * Set prix1
     *
     * @param string $prix1
     *
     * @return AnnoncePrix
     */
    public function setPrix1($prix1)
    {
        $this->prix1 = $prix1;

        return $this;
    }

    /**
     * Get prix1
     *
     * @return string
     */
    public function getPrix1()
    {
        return $this->prix1;
    }

    /**
     * Set datedebut2
     *
     * @param \DateTime $datedebut2
     *
     * @return AnnoncePrix
     */
    public function setDatedebut2($datedebut2)
    {
        $this->datedebut2 = $datedebut2;

        return $this;
    }

    /**
     * Get datedebut2
     *
     * @return \DateTime
     */
    public function getDatedebut2()
    {
        return $this->datedebut2;
    }

    /**
     * Set datefin2
     *
     * @param \DateTime $datefin2
     *
     * @return AnnoncePrix
     */
    public function setDatefin2($datefin2)
    {
        $this->datefin2 = $datefin2;

        return $this;
    }

    /**
     * Get datefin2
     *
     * @return \DateTime
     */
    public function getDatefin2()
    {
        return $this->datefin2;
    }

    /**
     * Set prix2
     *
     * @param string $prix2
     *
     * @return AnnoncePrix
     */
    public function setPrix2($prix2)
    {
        $this->prix2 = $prix2;

        return $this;
    }

    /**
     * Get prix2
     *
     * @return string
     */
    public function getPrix2()
    {
        return $this->prix2;
    }

    /**
     * Set datedebut3
     *
     * @param \DateTime $datedebut3
     *
     * @return AnnoncePrix
     */
    public function setDatedebut3($datedebut3)
    {
        $this->datedebut3 = $datedebut3;

        return $this;
    }

    /**
     * Get datedebut3
     *
     * @return \DateTime
     */
    public function getDatedebut3()
    {
        return $this->datedebut3;
    }

    /**
     * Set datefin3
     *
     * @param \DateTime $datefin3
     *
     * @return AnnoncePrix
     */
    public function setDatefin3($datefin3)
    {
        $this->datefin3 = $datefin3;

        return $this;
    }

    /**
     * Get datefin3
     *
     * @return \DateTime
     */
    public function getDatefin3()
    {
        return $this->datefin3;
    }

    /**
     * Set prix3
     *
     * @param string $prix3
     *
     * @return AnnoncePrix
     */
    public function setPrix3($prix3)
    {
        $this->prix3 = $prix3;

        return $this;
    }

    /**
     * Get prix3
     *
     * @return string
     */
    public function getPrix3()
    {
        return $this->prix3;
    }

    /**
     * Set datedebut4
     *
     * @param \DateTime $datedebut4
     *
     * @return AnnoncePrix
     */
    public function setDatedebut4($datedebut4)
    {
        $this->datedebut4 = $datedebut4;

        return $this;
    }

    /**
     * Get datedebut4
     *
     * @return \DateTime
     */
    public function getDatedebut4()
    {
        return $this->datedebut4;
    }

    /**
     * Set datefin4
     *
     * @param \DateTime $datefin4
     *
     * @return AnnoncePrix
     */
    public function setDatefin4($datefin4)
    {
        $this->datefin4 = $datefin4;

        return $this;
    }

    /**
     * Get datefin4
     *
     * @return \DateTime
     */
    public function getDatefin4()
    {
        return $this->datefin4;
    }

    /**
     * Set prix4
     *
     * @param string $prix4
     *
     * @return AnnoncePrix
     */
    public function setPrix4($prix4)
    {
        $this->prix4 = $prix4;

        return $this;
    }

    /**
     * Get prix4
     *
     * @return string
     */
    public function getPrix4()
    {
        return $this->prix4;
    }

    /**
     * Set datedebut5
     *
     * @param \DateTime $datedebut5
     *
     * @return AnnoncePrix
     */
    public function setDatedebut5($datedebut5)
    {
        $this->datedebut5 = $datedebut5;

        return $this;
    }

    /**
     * Get datedebut5
     *
     * @return \DateTime
     */
    public function getDatedebut5()
    {
        return $this->datedebut5;
    }

    /**
     * Set datefin5
     *
     * @param \DateTime $datefin5
     *
     * @return AnnoncePrix
     */
    public function setDatefin5($datefin5)
    {
        $this->datefin5 = $datefin5;

        return $this;
    }

    /**
     * Get datefin5
     *
     * @return \DateTime
     */
    public function getDatefin5()
    {
        return $this->datefin5;
    }

    /**
     * Set prix5
     *
     * @param string $prix5
     *
     * @return AnnoncePrix
     */
    public function setPrix5($prix5)
    {
        $this->prix5 = $prix5;

        return $this;
    }

    /**
     * Get prix5
     *
     * @return string
     */
    public function getPrix5()
    {
        return $this->prix5;
    }

    /**
     * Set annonce
     *
     * @param \LSI\MarketBundle\Entity\Annonce $annonce
     *
     * @return AnnoncePrix
     */
    public function setAnnonce(\LSI\MarketBundle\Entity\Annonce $annonce)
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
     * Add mairy
     *
     * @param \LSI\MarketBundle\Entity\PublicMairie $mairy
     *
     * @return AnnoncePrix
     */
    public function addMairy(\LSI\MarketBundle\Entity\PublicMairie $mairy)
    {
        $this->mairies[] = $mairy;

        return $this;
    }

    /**
     * Remove mairy
     *
     * @param \LSI\MarketBundle\Entity\PublicMairie $mairy
     */
    public function removeMairy(\LSI\MarketBundle\Entity\PublicMairie $mairy)
    {
        $this->mairies->removeElement($mairy);
    }

    /**
     * Get mairies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMairies()
    {
        return $this->mairies;
    }

    /**
     * Add administre
     *
     * @param \LSI\MarketBundle\Entity\PublicAdministre $administre
     *
     * @return AnnoncePrix
     */
    public function addAdministre(\LSI\MarketBundle\Entity\PublicAdministre $administre)
    {
        $this->administres[] = $administre;

        return $this;
    }

    /**
     * Remove administre
     *
     * @param \LSI\MarketBundle\Entity\PublicAdministre $administre
     */
    public function removeAdministre(\LSI\MarketBundle\Entity\PublicAdministre $administre)
    {
        $this->administres->removeElement($administre);
    }

    /**
     * Get administres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdministres()
    {
        return $this->administres;
    }
}
