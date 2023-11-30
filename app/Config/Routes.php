<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');


// Roles
$routes->group('roles', ['namespace' => 'App\Controllers\Role'], function ($routes) {
    $routes->get('', 'Home::index');
    $routes->get('new', 'WebController2::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
    
});
// PAGES
/* $routes->get('roles', 'role\WebController::index');
$routes->get('roles/new', "role\WebController::new");
$routes->get('roles/(:num)', "role\WebController::show/$1");
$routes->get('roles/edit/(:num)', "role\WebController::edit/$1"); */

// API
$routes->post('api/roles/v1/', "role\WebController::create");
$routes->put('api/roles/v1/(:num)', "role\WebController::update/$1");
$routes->delete('api/roles/v1/(:num)', "role\WebController::delete/$1");




//RUTAS Worker
//Pages
$routes->get('workers', 'worker\WebController::index');
$routes->get('workers/new', "worker\WebController::new");
$routes->get('workers/(:num)', "worker\WebController::show/$1");
$routes->get('workers/edit/(:num)', "worker\WebController::edit/$1");

//api
$routes->post('workers', "worker\WebController::create");
$routes->put('workers/(:num)', "worker\WebController::update/$1");
$routes->delete('workers/(:num)', "worker\WebController::delete/$1");


//Rutas clients
//Pages
$routes->get('clients', 'client\WebController::index');
$routes->get('clients/new', "client\WebController::new");
$routes->get('clients/(:num)', "client\WebController::show/$1");
$routes->get('clients/edit/(:num)', "client\WebController::edit/$1");

//api
$routes->post('api/clients/v1', "client\WebController::create");
$routes->put('api/clients/v1/(:num)', "client\WebController::update/$1");
$routes->delete('api/clients/v1/(:num)', "client\WebController::delete/$1");


//Rutas cinema
//Pages
$routes->get('cinemas', 'cinema\WebController::index');
$routes->get('cinemas/new', "cinema\WebController::new");
$routes->get('cinemas/(:num)', "cinema\WebController::show/$1");
$routes->get('cinemas/edit/(:num)', "cinema\WebController::edit/$1");

//api
$routes->post('api/cinemas/v1', "cinema\WebController::create");
$routes->put('api/cinemas/v1/(:num)', "cinema\WebController::update/$1");
$routes->delete('api/cinemas/v1/(:num)', "cinema\WebController::delete/$1");

//Rutas config
//Pages
$routes->get('configs', 'config\WebController::index');
$routes->get('configs/new', "config\WebController::new");
$routes->get('configs/(:num)', "config\WebController::show/$1");
$routes->get('configs/edit/(:num)', "config\WebController::edit/$1");

//api
$routes->post('api/configs/v1', "config\WebController::create");
$routes->put('api/configs/v1/(:num)', "config\WebController::update/$1");
$routes->delete('api/configs/v1/(:num)', "config\WebController::delete/$1");