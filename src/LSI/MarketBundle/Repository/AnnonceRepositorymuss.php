<?php

namespace LSI\MarketBundle\Repository;


use Doctrine\ORM\EntityRepository;
use LSI\MarketBundle\Entity\Categorie;

class AnnonceRepository extends EntityRepository {

    // Recuperer l'auteur d'une annonce.
    public function findAuteurAnnonce($id){ // $id est l'id de la mairie auteure de l'annonce
        $qb = $this->createQueryBuilder('m')
                    ->join('m.id', 'LSI\MarketBundle\Entity\User u')
                    ->addSelect('u')
                    ;

        $qb
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->andWhere('m.id = u.mairie')
            ;
        return $qb->getQuery()->getScalarResult();
    }

    // Recuperer les annonces en fonction de leurs auteurs.
    public function findMesAnnonces($id){ //$id est l'id de l'auteur de l'annonce
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.mairie = :id')
                ->setParameter('id', $id);

        //Retourne un tableau d'annonce.
        return $qb->getQuery()->getResult();
    }

    // recuperer le titre de l'annonce en fonction de son id
    public function titreAnnonce($id){
        $qb = $this->createQueryBuilder('a')
                    ->select('a.titre') // Pour selectionner le titre
        ;

        $qb->where('a.id = :id')
            ->setParameter('id', $id)
            ;
        // Retourner un seul resultat, le titre de l'annonce concernee.
        return $qb->getQuery()->getSingleResult();
    }

    /*
     * Requête de recherche d'une annonce à travers le titre ou la description
     * */
    public function findAnnParTitreOuDescp($motcle)  {
        $queryb = $this->createQueryBuilder('a');
        $queryb->innerJoin('a.images', 'img')
            ->where('a.titre like :titre or a.description like :description')
            ->setParameter('titre', '%'.$motcle.'%')
            ->setParameter('description', '%'.$motcle.'%');

        return $queryb->getQuery()->getResult();
    }


// Recherche par titre ou description
    public function findTitreDescp($mot)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('a.images', 'img')
            ->innerJoin('a.categorie', 'categ')
            ->addSelect('categ')
            ->addSelect('img')
            ->where('a.titre like :titre or a.description like :description')
            ->setParameter('titre', '%'.$mot.'%')
            ->setParameter('description', '%'.$mot.'%');

        $result = $qb->getQuery()->getResult();
        return $result;
    }

    // Recherche par categorie

    public function findCategorie($categorie){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('an.images', 'img')
            ->addSelect('img')
            ->innerJoin('an.categorie', 'categ')
            ->addSelect('categ')
            ->where('categ.id= :id')
            ->setParameter('id', $categorie);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // Recherche par categorie ou prix

    public function findCategorieAndPrix($categorie, $prix){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('a.images', 'img')
            ->addSelect('img')
            ->innerJoin('a.categorie', 'categ')
            ->addSelect('categ')
            ->where('categ.id= :id')
            ->setParameter('id', $categorie)
            ->orwhere('a.prixDefaut < :prixDefaut')
            ->setParameter('prixDefaut', $prix);
        $query->getQuery()->getResult();

        return $query;
    }

    // Recherche par Budget

    public function findBudget($budget){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('an.images', 'img')
            ->addSelect('img')
            ->innerJoin('an.categorie', 'categ')
            ->addSelect('categ')
            ->where('an.prixDefaut<= :prixDefaut')
            ->setParameter('prixDefaut', $budget);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // Recherche par periode

    public function findPeriode($date){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('an.images', 'img')
            ->addSelect('img')
            ->innerJoin('an.categorie', 'categ')
            ->addSelect('categ')
            ->where('an.dateCreation= :dateCreation')
            ->setParameter('dateCreation', $date);
        $result = $query->getQuery()->getResult();

        return $result;
    }
    // Recherche par la ville
    public function findVille($ville){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('an.images', 'img')
            ->addSelect('img')
            ->innerJoin('an.categorie', 'categ')
            ->addSelect('categ')
            ->innerJoin('an.mairie', 'm')
            ->addSelect('m')
            ->innerJoin('m.user', 'u')
            ->addSelect('u')
            ->where('u.ville= :ville')
            ->setParameter('dateCreation', $ville);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    // Recherche par la ville et categorie et prix et statut
    public function findVilleAndPeriodAndCategAndDate($ville,$categ, $prix,$libelle){
        $query = $this->createQueryBuilder('an');
        $query->innerJoin('an.images', 'img')
            ->addSelect('img')
            ->innerJoin('an.statut', 'stat')
            ->addSelect('stat')
            ->where('an.prixDefaut >= :prixDefaut')
            ->setParameter('prixDefaut', $prix)
            ->andWhere('stat.libelle >= :libelle')
            ->setParameter('libelle', $libelle)
            ->innerJoin('an.categorie', 'categ')
            ->addSelect('categ')
            ->where('categ.id= :id')
            ->setParameter('id', $categ)
            ->innerJoin('an.mairie', 'm')
            ->addSelect('m')
            ->innerJoin('m.user', 'u')
            ->addSelect('u')
            ->where('u.ville= :ville')
            ->setParameter('dateCreation', $ville);
        $result = $query->getQuery()->getResult();

        return $result;
    }

    public function requeteAffiner(Categorie $cat, $ville, $budget, $periode, $prix){
        $qb = $this->createQueryBuilder('a')
                    ->leftJoin('a.image', 'i')
                    ->addSelect('i')
        ;

        // Ajoute la catégorie si elle n'est pas vide...
        if ($cat !== null) {
            $qb->leftJoin('a.categorie', 'c')
                ->addSelect('c')
                ->where('c.id = :cat')
                ->setParameter('cat', $cat);
        }

        // ...
        if ($ville !== null) {
            $qb->leftJoin('a.mairie', 'm')
                ->addSelect('m')
                ->join('m.id', 'u')
                ->addSelect('u')
                ->andWhere('m.id = u.mairie')
                ->andWhere('u.ville = :ville')
                ->setParameter('ville', $ville);
        }

        // ...
        if($budget !== null){
            $qb->andWhere('a.prixDefaut <= :budget')
                ->setParameter('budget', $budget);
        }

        // Période n'est pas encore définie dans la création de l'annonce...
        if($periode !== null){

        }

        if($prix !== null){
            $qb->andWhere('a.prixDefaut = :prix')
                ->setParameter('prix', $prix);
        }

        return $qb->getQuery()->getResult();
    }

    // 
    public function findPeriodDispo($debut, $fin) {
        $qb = $this->createQueryBuilder('a')
                   ->innerJoin('a.calendrier', 'c')
                    ->addSelect('c')
                    ->where('c.debut = :debut')
                    ->setParameter('debut', $debut)
                    ->andWhere('c.fin = :fin')
                    ->setParameter('fin', $fin);
        return $qb->getQuery()->getResult();

    }

    // Récupère le calendrier d'une annonce
    public function findAnnoncesAvecCalendrier($id){
        $qb = $this->createQueryBuilder('a')
            ->join('a.calendrier', 'c')
            ->addSelect('c')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ;
        return $qb->getQuery()->getResult();

    }

    // Requête qui renvoie id de la mairie qui a cree l'annonce
    public function idmairieannonce($id){
        $req = $this->createQueryBuilder('a');
                    $req->innerJoin('a.mairie', 'm')
                        ->addSelect('m');

        $req->where('a.id= :id')
            ->setParameter('id', $id);

        return $req->getQuery()->getResult();
    }

    // Requete pour afficher le resultat de la barre de recherche principale

    public function findTitreDescpP($mot)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->innerJoin('a.images', 'img')
            ->addSelect('img')
            ->innerJoin('a.categorie', 'categ')
            ->addSelect('categ')
            ->innerJoin('a.mairie', 'm')
            ->addSelect('m')
            ->where('a.titre like :titre or a.description like :description')
            ->setParameter('titre', '%'.$mot.'%')
            ->setParameter('description', '%'.$mot.'%');

        $result = $qb->getQuery()->setMaxResults(10)->getResult();
        return $result;
    }

    // Afficher l'image d'une annonce lors de la modification

    public function affichimg($id){
        $req = $this->createQueryBuilder('a');
                $req->innerJoin('a.images', 'img')
                    ->addSelect('img');

                $req->where('a.id= :id')
                    ->setParameter('id', $id);

                return $req->getQuery()->getResult();
    }

    // Requête de recherche pour la page de recherche

    // titre

    public function findrechetitreindex($titre){

        $req = $this->createQueryBuilder('a');

        $req->innerJoin('a.adresse', 'adress')
            ->addSelect('adress');

        $req->where('a.titre= :titre')
            ->setParameter('titre', $titre);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // ville

    public function findrechetitrevilleindex($ville){

        $req = $this->createQueryBuilder('a');
        $req->innerJoin('a.adresse', 'adress')
            ->addSelect('adress');
        $req->where('adress.ville= :ville')
            ->setParameter('ville', $ville);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // Titre et la ville

    public function findtitretitrevilleindex($titre, $ville){

        $req = $this->createQueryBuilder('a');
        $req->innerJoin('a.adresse', 'adress')
            ->addSelect('adress');
        $req->where('adress.ville= :ville')
            ->setParameter('ville', $ville)
            ->andWhere('a.titre= :titre')
            ->setParameter('titre', $titre);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // disponibilite

    public function finddispoindex($datedebut, $datefin){

        $req = $this->createQueryBuilder('a');
        $req->innerJoin('a.calendrier', 'calendar')
            ->addSelect('calendar');
        $req->where('calendar.debut= :debut')
            ->setParameter('debut', $datedebut)
            ->andWhere('calendar.fin= :fin')
            ->setParameter('fin', $datefin);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // titre et disponibilite

    public function titreperiodeindex($titre, $datedebut, $datefin){

        $req = $this->createQueryBuilder('a');
        $req->innerJoin('a.calendrier', 'calendar')
            ->addSelect('calendar')
            ;
        $req->where('a.titre= :titre')
            ->setParameter('titre', $titre)
            ->andWhere('calendar.debut= :debut')
            ->setParameter('debut', $datedebut)
            ->andWhere('calendar.fin= :fin')
            ->setParameter('fin', $datefin);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // Ville et disponibiite

    public function villeperiodeindex($ville, $datedebut, $datefin){

        $req = $this->createQueryBuilder('a');

        $req->innerJoin('a.calendrier', 'calendar')
            ->addSelect('calendar')
            ->innerJoin('a.adresse', 'adress')
            ->addSelect('adress');

        $req->where('adress.ville= :ville')
            ->setParameter('ville', $ville)
            ->andWhere('calendar.debut= :debut')
            ->setParameter('debut', $datedebut)
            ->andWhere('calendar.fin= :fin')
            ->setParameter('fin', $datefin);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }

    // titre et ville et disponibilite

    public function titrevilleperiodeindex($titre, $ville, $datedebut, $datefin){

        $req = $this->createQueryBuilder('a');

        $req->innerJoin('a.calendrier', 'calendar')
            ->addSelect('calendar')
            ->innerJoin('a.adresse', 'adress')
            ->addSelect('adress');

        $req->where('a.titre= :titre')
            ->setParameter('titre', $titre)
            ->andWhere('adress.ville= :ville')
            ->setParameter('ville', $ville)
            ->andWhere('calendar.debut= :debut')
            ->setParameter('debut', $datedebut)
            ->andWhere('calendar.fin= :fin')
            ->setParameter('fin', $datefin);

        return $req->getQuery()->setMaxResults(10)->getResult();
    }



}