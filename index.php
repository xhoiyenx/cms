<?php
define('BASE_PATH', __DIR__);
define('START_TIME', microtime());
define('FOOTPRINT', 'Developed By: <a href="mailto::hoiyen.2000@gmail.com">Hoiyen</a>');

/*
|--------------------------------------------------------------------------
| Register helper functions file
|--------------------------------------------------------------------------
*/

require_once 'includes/functions.php';

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require 'includes/vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = 'resources/cache/compiled.php';

if (file_exists($compiledPath)) {
  require $compiledPath;
}

$app = require_once 'includes/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel   = $app->make( Illuminate\Contracts\Http\Kernel::class );
$request  = Illuminate\Http\Request::capture();
$response = $kernel->handle( $request );
$response->send();

$kernel->terminate($request, $response);

#dump( microtime() - START_TIME );