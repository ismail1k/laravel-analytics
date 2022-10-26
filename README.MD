# laravel-Statistics
The package can help you collect statistics about your Laravel application.

## Installation
First, install Package to your laravel project with Composer using command bellow:
```shell
composer require "ismail1k/laravel-statistics"
```
then add these follow lines to `config/app.php`:
```php
  'providers' => [
      Ismail1k\LaravelStatistics\ServiceProvider::class,
  ],
  'aliases' => [
      'Tracker' => Ismail1k\LaravelStatistics\CartServiceProvider::class,
  ],
```

Now, open `app/Http/kernel.php` and add this line:
```php
  protected $routeMiddleware = [
       ...
      'tracker' => \App\Http\Middleware\TrackerMiddleware::class,
  ];
```

Next step, publish some files: 
```shell
php artisan vendor:publish --provider="Ismail1k\LaravelStatistics\ServiceProvider"
```
then, run the follow command line:
```shell
php artisan migrate
```

## Usage
If you want to track all your routes, open `app/Providers/RouteServiceProvider.php` add tracker middleware to your web group routes like this:
```php
  Route::middleware(['web', 'tracker'])
      ->group(base_path('routes/web.php'));
```
Also do this if you want to track your api group routes:
```php
  Route::middleware(['api', 'tracker'])
      ->prefix('api')
      ->group(base_path('routes/api.php'));
```
Or you can track requests from Controller like this:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tracker;

class HomeController extends Controller
{
    public function index(Request $request){
        Tracker::log($request);
        return view('welcome');
    }
}
```

You can get sessions like using:
```php
    $sessions = Tracker::sessions(60*24); //sessions for last 24H
    //Note: $sessions contain: IP, user, Location, Device, Browser, Traffic...
```

Or, If you want to get just the number of sessions:
```php
    $traffic = Tracker::traffic(60*24); //traffics for last 24H
```