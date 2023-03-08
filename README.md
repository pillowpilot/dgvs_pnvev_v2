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

PHP version on production server: 5.4.16

Usefull commands
----------------
- Run `npm run dev` to compile and generate all files to serve.
- Run `php artisan serve` to run the development server.

Set Database
------------

1. Set default credentials: `root:` (empty password).

2. Create database and populate:
```
mysql -u root -p
CREATE DATABASE dgvsops;
USE dgvsops;
source /home/ubuntu/dgvs_pnvev_v2/epiweek_DDL.sql
source /home/ubuntu/dgvs_pnvev_v2/epiweek_DATA.sql
source /home/ubuntu/dgvs_pnvev_v2/frm_fleishmaniasis_DDL.sql
source /home/ubuntu/dgvs_pnvev_v2/frm_fleishmaniasis_DATA.sql
source /home/ubuntu/dgvs_pnvev_v2/frm_fchagas_DDL.sql
source /home/ubuntu/dgvs_pnvev_v2/frm_fchagas_DATA.sql
```

Deployment
----------

frm_fleishmaniasis y epiweek deben de estar listos en la DB con root: (sin contraseña)

**Database must be populated by this point.**

1. Update local repo:
```
cd /home/ubuntu/dgvs_pnvev_v2
git pull
```
2. Copy local repo into the webserver dir:
```
sudo -i
cd /opt/lampp/htdocs/
rm -r dgvs_pnvev_v2
cp -r /home/ubuntu/dgvs_pnvev_v2 .
```
3. Set proper permissions:
```
chown -R daemon:daemon dgvs_pnvev_v2
chmod +x dgvs_pnvev_v2
```
4. Install dependencies:
```
cd dgvs_pnvev_v2
sh install-composer.sh
cd pnvev
php ../composer.phar install # Accept if asks to keep running as root
```
5. Run post scripts:
```
cp .env.example .env
php artisan key:generate
nano .env # Replace APP_ENV=local for APP_ENV=production
php artisan migrate:refresh --seed # Yes to everything
```

Manually create an user
-----------------------
1. Run `php artisan tinker`.
2. Type 
```
$u = new App\User();
$u->name = 'Administrator';
$u->email = 'admin';
$u->password = Hash::make('admin');
$u->save();
```