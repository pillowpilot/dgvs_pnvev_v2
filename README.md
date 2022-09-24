./install-composer.sh
php composer.phar create-project laravel/laravel=5.1.33 pnvev --prefer-dist

To serve (dev)
php ./pnvev/artisan serve

Project Structure
(root) Project related stuff (deploy, install, etc.)
/pnvev Actual project
/pnvev/resources/views Views
/pnvev/app/Http/routes.php Router

php ./pnvev/artisan make:model Caso -m
php ./pnvev/artisan migrate:fresh --seed
