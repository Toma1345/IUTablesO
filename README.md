# SAÉ PHP - IUTables'O

>**Chef de projet** : Thomas Brossier  
>**Membres de l'équipe** : Claire Deneau, Kylian Dumas, Nicolas Nauche

## Comment installer l'application ?
### Pré-requis
> Avoir d'installer `composer` sur sa machine.  
> Pour le vérifier, vous pouvez exécuter : `composer -V`

### Commande à exécuter avant le lancement de l'application
Le fichier `composer.json` existe déjà, il vous suffit donc de réaliser la commande suivante : `composer install`. Cela va télécharger les dépendances nécessaire à notre projet et va vous créer un dossier `/vendor`.

## Comment lancer l'application ?
Afin de pouvoir lancer l'application, il faut être présent dans le dossier `/app/public` du projet, pour cela déplacer vous dans celui-ci.
> Si vous êtes à la racine du projet, exécuter la commande suivante : `cd ./app/public/`.
Une fois dans ce repertoire, vous pouvez lancer le site via la commande : `php -S localhost:5000`.

> Il ne reste plus qu'à accéder au lien : [http://localhost:5000](http://localhost:5000)

## Les fonctionnalités implémentées
### Pour un visiteur non connecté
- Module de recherche
    - via recherche textuelle
    - via recherche par critères (types / cuisines)
    - via des options (par exemple : livraison ou à emporter)
- Module d'inscription
- Module de connexion
- Module de visualisation des caractéristiques d'un restaurant
- Ecran d'accueil affichant les restaurants les mieux notés (**_fonctionnalités supplémentaires_**)

### Pour un visiteur connecté (donc préalablement inscrit)
- Accès à toutes les pages que l'utilisateur non connecté à accès (excepté inscription et connexion car il est déjà connecté)
- Visualisation des notes laissés par les autres utilisateurs
- Visusalisation des avis/critiques laissés par les autres utilisateurs
- Accès au information de son profil (adresse renseigné lors de l'inscription, téléphone, email)
- Administration de ses avis (suppression / accès direct au détail du restaurant)
