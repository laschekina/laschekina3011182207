<?php
/**
 * Created by PhpStorm.
 * User: Sylvanus KONAN
 * Date: 18/09/2018
 * Time: 01:08
 */

namespace LSI\MarketBundle\DoctrineListener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use LSI\MarketBundle\Email\EnvoyerMail;
use LSI\MarketBundle\Entity\Annonce;
use LSI\MarketBundle\Entity\User;

class CreationAnnonceListener {

    /**
     * @var EnvoyerMail
     */
    private $envoyerMail;
    /**
     * @var Annonce
     */
    private $annonce;

    /**
     * CreationAnnonceListener constructor.
     * @param EnvoyerMail $envoyerMail
     *
     *, Annonce $annonce = null
     */
    public function __construct(EnvoyerMail $envoyerMail) {
        $this->envoyerMail = $envoyerMail;
        //$this->annonce = $annonce;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();
        //dump($args->getObject());
        //dump($this->annonce); die();
        if (!$entity instanceof User){
            return;
        }
        //, $this->annonce
        $this->envoyerMail->sendCreationAnnonceMail($entity);
    }
}