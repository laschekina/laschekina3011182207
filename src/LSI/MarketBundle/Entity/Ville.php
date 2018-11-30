<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\VilleRepository")
 */
class Ville
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="LSI\MarketBundle\Entity\Epci")
     * @ORM\JoinColumn(nullable=false)
     */
    private $epci;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Ville
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set epci
     *
     * @param \LSI\MarketBundle\Entity\Epci $epci
     *
     * @return Ville
     */
    public function setEpci(\LSI\MarketBundle\Entity\Epci $epci)
    {
        $this->epci = $epci;

        return $this;
    }

    /**
     * Get epci
     *
     * @return \LSI\MarketBundle\Entity\Epci
     */
    public function getEpci()
    {
        return $this->epci;
    }
}
