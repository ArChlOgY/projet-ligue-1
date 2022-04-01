# projet-ligue-1
Créer un tableau du classement de la ligue 1

Language : PHP - HTML - CSS

Base de donnée : Oui

TO-DO

- [ ] Ajouter la liste des matchs sur la page "Ajouter un match"
- [ ] Terminé la page détail du club (clic sur le club depuis le classement)
- [ ] Afficher le détail des matchs dans ajout match
- [ ] Vérifier les contraintes de clé étrangère
- [ ] Vérifier que le site soit complétement responsive
- [ ] Ajuster les couleurs
- [ ] Simplifier l'experience utilisateurs (guide utilisateur ^^)
- [ ] Récupérer les données automatiquement

COMPLETED

- [x] Créer une interface responsive HTML/CSS (Bootstrap)
- [x] L'utilisateur doit saisir ses identifiants pour consulter le classement
- [x] Faire une vérification des identifiants en PHP (méthode POST)
- [x] Retourner le traitement sur la page d'index (méthode GET)
- [x] Indiquer un message d'erreur sur la page d'index si les identifiants sont incorrects
- [x] Récupérer les données du classement et construire un tableau PHP multidimensionnel
- [x] Récupérer les logos de chaque club
- [x] Indiquer par un code couleur le statut Qualification/Relégation
- [x] Ajouter la légende couleur dans un menu accordeon
- [x] Publier sur Github
- [x] Utiliser un compte utilisateur (email/password) avec le bon niveau de sécurité
- [x] Utiliser une variable de session pour le login
- [x] Ajout bouton login/logout
- [x] Ajouter un menu avec les onglets (accueil - ajouter un club - ajouter le résultat d'un match)
- [x] Stocker les données dans une base de donnée
- [x] Possibilité d'ajouter un club avec des requêtes préparées (PDO)
- [x] Possibilité de charger un logo (image) avec un controle de fichier/taille
- [x] Possibilité d'ajouter un matchs avec des requêtes préparées (PDO)
- [x] Stocker les données dans une base de donnée
- [x] Afficher le classement sur la page d'acceuil avec les résultats enregistrés par l'utilisateur
- [x] Affichier une erreur si aucun logo n'est chargé

## DEMO
https://foreach.alwaysdata.net/projet-ligue-1/

## LOGIN (screenshot)

![Login](/assets/screen/01.login.jpg)

## LOGIN ERROR (screenshot)

![Login Error](/assets/screen/02.error.jpg)

## LOGIN SUCCESS (screenshot)

![Login Success](/assets/screen/03.success.jpg)

## LEGENDE (screenshot)

![Legende](/assets/screen/04.legende.jpg)

## DESKTOP (screenshot)

![Desktop](/assets/screen/05.desktop.jpg)

## MOBILE (screenshot)

![Mobile](/assets/screen/06.mobile.jpg)

## AJOUT MATCH (screenshot)

![Ajout Match](/assets/screen/07.ajoutermatch.jpg)

## AJOUT CLUB (screenshot)

![Ajout Club](/assets/screen/08.ajouterclub.jpg)
