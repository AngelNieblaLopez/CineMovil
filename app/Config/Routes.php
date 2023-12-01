<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');


// Pages
$routes->group('roles', ['namespace' => 'App\Controllers\role'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('workers', ['namespace' => 'App\Controllers\worker'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('clients', ['namespace' => 'App\Controllers\client'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('cinemas', ['namespace' => 'App\Controllers\cinema'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('configs', ['namespace' => 'App\Controllers\config'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});



// API
$routes->group('api', function ($routes) {
    $routes->group('web', function ($routes) {
        $routes->group('roles', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\role'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('workers', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\worker'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('clients', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\client'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('cinemas', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\cinema'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('configs', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\config'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
    });
    $routes->group('rest', function ($routes) {
        $routes->group('client', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\client'], function ($routes) {
                $routes->get('login', "RestController::login");
                $routes->post('', "RestController::create");
            });
        });
    });
});
