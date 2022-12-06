<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
	realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
	'Illuminate\Contracts\Http\Kernel',
	'App\Http\Kernel'
);

$app->singleton(
	'Illuminate\Contracts\Console\Kernel',
	'App\Console\Kernel'
);

$app->singleton(
	'Illuminate\Contracts\Debug\ExceptionHandler',
	'App\Exceptions\Handler'
);

/*
|--------------------------------------------------------------------------
| Inicializacion del directorio Storage
|--------------------------------------------------------------------------
|
| Para produccion, se crea el storage temporal en la carpeta temporal
| del S.O. (linux)
|
*/

$storagePath = '/tmp/pnvev_dashboard/storage';  # Ruta de la carpeta temporal
$required_dirs = [
	"$storagePath",
	"$storagePath/app",
	"$storagePath/framework/cache",
	"$storagePath/framework/sessions",
	"$storagePath/framework/views",
	"$storagePath/logs",
];
foreach ($required_dirs as $required_dir) {
	if (!file_exists($required_dir)) {
		mkdir($required_dir, 0777, true);
	}
}
$app->useStoragePath($storagePath);


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
