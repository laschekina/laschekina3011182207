<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fonction
 *
 * @ORM\Table(name="fonction")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\FonctionRepository")
 */
class Fonction
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
     * @ORM\Column(name="name_fonction", type="string", length=255, unique=true)
     */
    protected $nameFonction;


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
     * Set nameFonction
     *
     * @param string $nameFonction
     *
     * @return Fonction
     */
    public function setNameFonction($nameFonction)
    {
        $this->nameFonction = $nameFonction;

        return $this;
    }

    /**
     * Get nameFonction
     *
     * @return string
     */
    public function getNameFonction()
    {
        return $this->nameFonction;
    }
}

