./install-composer.sh
php composer.phar create-project laravel/laravel=5.1.33 pnvev --prefer-dist

Make sure to give ownership to the xampp apache user and execution permissions
chown -R deamon:deamon /opt/lampp/htdocs
chmod -R +x /opt/lampp/htdocs

To serve (dev)
php ./pnvev/artisan serve

Project Structure
(root) Project related stuff (deploy, install, etc.)
/pnvev Actual project
/pnvev/resources/views Views
/pnvev/app/Http/routes.php Router

All DB tables MUST have the prefix "pnvev_", and for views "v_pnvev_"

php ./pnvev/artisan make:model Caso -m
php ./pnvev/artisan migrate:refresh --seed

If seeding (or migration) fails, try: composer dump-autoload
