<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nature
 *
 * @ORM\Table(name="nature")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\NatureRepository")
 */
class Nature
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
     * @ORM\Column(name="name_nature", type="string", length=255, unique=true)
     */
    protected $nameNature;


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
     * Set nameNature
     *
     * @param string $nameNature
     *
     * @return Nature
     */
    public function setNameNature($nameNature)
    {
        $this->nameNature = $nameNature;

        return $this;
    }

    /**
     * Get nameNature
     *
     * @return string
     */
    public function getNameNature()
    {
        return $this->nameNature;
    }
}

