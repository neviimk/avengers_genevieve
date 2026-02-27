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