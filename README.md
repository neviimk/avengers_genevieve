# 1. Création du projet
symfony new avengers_mon-prenom --webapp
cd avengers_mon-prenom

# 2. Création du contrôleur pour l'affichage
php bin/console make:controller BookmarkController

# 3. Création de la base de données
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
php bin/console doctrine:database:create

# 4. Création de l'entité MarquePage
php bin/console make:entity MarquePage

# 5. Génération de la migration et application à la base
php bin/console make:migration
php bin/console doctrine:migrations:migrate

# 6. Commandes git pour relier mon projet à Github
    git branch -M main : Renommer ma branche principale 'main'
    git remote add origin https://github.com/neviimk/avengers_genevieve.git : Ajouter l'adresse de mon dépôt distant
    git push -u origin main : envoyer mon code pour la première fois vers le dépôt distant
    git push : envoyer mes sauvegardes locales vers Github
    git commit -m "Description" : Créer un point de sauvegarde avec un message descriptif 