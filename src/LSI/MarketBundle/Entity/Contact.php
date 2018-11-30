<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="contact_firstname", type="string", length=255)
     */
    private $contactFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_secondname", type="string", length=255, nullable=true)
     */
    private $contactSecondname;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_image", type="string", length=255, nullable=true)
     */
    private $contactImage;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_location", type="string", length=255, nullable=true)
     */
    private $contactLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=255, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_context", type="string", length=255, nullable=true)
     */
    private $contactContext;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_context_id", type="string", length=255, nullable=true)
     */
    private $contactContextId;


    /**
     * @var string
     *
     * @ORM\Column(name="contact_message", type="string", length=255)
     */
    private $contactMessage;


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
     * Set contactFirstname
     *
     * @param string $contactFirstname
     *
     * @return Contact
     */
    public function setContactFirstname($contactFirstname)
    {
        $this->contactFirstname = $contactFirstname;

        return $this;
    }

    /**
     * Get contactFirstname
     *
     * @return string
     */
    public function getContactFirstname()
    {
        return $this->contactFirstname;
    }

    /**
     * Set contactSecondname
     *
     * @param string $contactSecondname
     *
     * @return Contact
     */
    public function setContactSecondname($contactSecondname)
    {
        $this->contactSecondname = $contactSecondname;

        return $this;
    }

    /**
     * Get contactSecondname
     *
     * @return string
     */
    public function getContactSecondname()
    {
        return $this->contactSecondname;
    }

    /**
     * Set contactImage
     *
     * @param string $contactImage
     *
     * @return Contact
     */
    public function setContactImage($contactImage)
    {
        $this->contactImage = $contactImage;

        return $this;
    }

    /**
     * Get contactImage
     *
     * @return string
     */
    public function getContactImage()
    {
        return $this->contactImage;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Contact
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactMessage
     *
     * @param string $contactMessage
     *
     * @return Contact
     */
    public function setContactMessage($contactMessage)
    {
        $this->contactMessage = $contactMessage;

        return $this;
    }

    /**
     * Get contactMessage
     *
     * @return string
     */
    public function getContactMessage()
    {
        return $this->contactMessage;
    }



    /**
     * Set contactLocation
     *
     * @param string $contactLocation
     *
     * @return Contact
     */
    public function setContactLocation($contactLocation)
    {
        $this->contactLocation = $contactLocation;

        return $this;
    }

    /**
     * Get contactLocation
     *
     * @return string
     */
    public function getContactLocation()
    {
        return $this->contactLocation;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Contact
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactContext
     *
     * @param string $contactContext
     *
     * @return Contact
     */
    public function setContactContext($contactContext)
    {
        $this->contactContext = $contactContext;

        return $this;
    }

    /**
     * Get contactContext
     *
     * @return string
     */
    public function getContactContext()
    {
        return $this->contactContext;
    }

    /**
     * Set contactContextId
     *
     * @param string $contactContextId
     *
     * @return Contact
     */
    public function setContactContextId($contactContextId)
    {
        $this->contactContextId = $contactContextId;

        return $this;
    }

    /**
     * Get contactContextId
     *
     * @return string
     */
    public function getContactContextId()
    {
        return $this->contactContextId;
    }
}
