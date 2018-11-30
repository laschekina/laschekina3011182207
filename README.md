# laschekina3011182207
Dépot du 30 Novembre 01h 20 (Contient les mises à jour jusqu'au 30/11 à 01h20)

1. Récupération du code

- Via l'invite de commande git bash (nécessite d'installer git)
- Exécuter la commande <code>git clone</code> suivi de l'url du dépot.
- (Si après avoir fait le b., la dossier <code>var/</code> n'apparait pas dans votre repertoire local, créez-le avant de passer au point suivant)

2. Télécharger les vendors
Avec composer
<code>php composer.phar install</code>

3. Créer la base de données

- <code>php bin/console doctrine:database:create</code>

4. Importer les tables de la base existante dans votre base
