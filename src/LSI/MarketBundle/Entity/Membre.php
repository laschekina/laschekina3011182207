<?php

namespace LSI\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="LSI\MarketBundle\Repository\MembreRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Membre
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
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $fonction;

    /**
     * @var bool
     *
     * @ORM\Column(name="devis", type="boolean", nullable=true)
     */
    private $devis;

    /**
     * @var bool
     *
     * @ORM\Column(name="contrat_achat", type="boolean", nullable=true)
     */
    private $contratAchat;

    /**
     * @var bool
     *
     * @ORM\Column(name="vente", type="boolean", nullable=true)
     */
    private $vente;

    /**
     * @var bool
     *
     * @ORM\Column(name="reference", type="boolean", nullable=true)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="LSI\MarketBundle\Entity\Mairie", cascade={"persist"})
     *
     */
    protected $mairie;


    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;


    /**
     * @var UploadedFile
     */
    private $file;

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;

    /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Le nom du fichier est son id, on doit juste stocker également son extension
    // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
    $this->url = $this->file->guessExtension();

    // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Si on avait un ancien fichier (attribut tempFilename non null), on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « id.extension »
    );
  }

   /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
    return 'uploads/membre/img';
  }

   protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }

  public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
  }


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
     * @return Membre
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Membre
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set devis
     *
     * @param boolean $devis
     *
     * @return Membre
     */
    public function setDevis($devis)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return bool
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set contratAchat
     *
     * @param boolean $contratAchat
     *
     * @return Membre
     */
    public function setContratAchat($contratAchat)
    {
        $this->contratAchat = $contratAchat;

        return $this;
    }

    /**
     * Get contratAchat
     *
     * @return bool
     */
    public function getContratAchat()
    {
        return $this->contratAchat;
    }

    /**
     * Set vente
     *
     * @param boolean $vente
     *
     * @return Membre
     */
    public function setVente($vente)
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * Get vente
     *
     * @return boolean
     */
    public function getVente()
    {
        return $this->vente;
    }

    /**
     * Set reference
     *
     * @param boolean $reference
     *
     * @return Membre
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return boolean
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set mairie
     *
     * @param \LSI\MarketBundle\Entity\Mairie $mairie
     *
     * @return Membre
     */
    public function setMairie(\LSI\MarketBundle\Entity\Mairie $mairie = null)
    {
        $this->mairie = $mairie;

        return $this;
    }

    /**
     * Get mairie
     *
     * @return \LSI\MarketBundle\Entity\Mairie
     */
    public function getMairie()
    {
        return $this->mairie;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Membre
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Membre
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Membre
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }


   /**
   * @return UploadedFile
   */
  public function getFile()
  {
    return $this->file;
  }

  /**
   * @param UploadedFile $file
   */
  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;

    // On vérifie si on avait déjà un fichier pour cette entité
    if (null !== $this->url) {
      // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->url;

      // On réinitialise les valeurs des attributs url et alt
      $this->url = null;
      $this->alt = null;
    }
  }
}
