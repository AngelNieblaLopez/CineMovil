<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');


// Roles
// PAGES
$routes->get('roles', 'RoleController::index');
$routes->get('roles/new', "RoleController::new");
$routes->get('roles/(:num)', "RoleController::show/$1");
$routes->get('roles/edit/(:num)', "RoleController::edit/$1");

// API
$routes->post('api/roles/v1/', "RoleController::create");
$routes->put('api/roles/v1/(:num)', "RoleController::update/$1");
$routes->delete('api/roles/v1/(:num)', "RoleController::delete/$1");




//RUTAS Worker
//Pages
$routes->get('workers', 'WorkerController::index');
$routes->get('workers/new', "WorkerController::new");
$routes->get('workers/(:num)', "WorkerController::show/$1");
$routes->get('workers/edit/(:num)', "WorkerController::edit/$1");

//api
$routes->post('workers', "WorkerController::create");
$routes->put('workers/(:num)', "WorkerController::update/$1");
$routes->delete('workers/(:num)', "WorkerController::delete/$1");


//Rjutas cinema

$routes->get('cinemas', 'CinemaController::index');
$routes->get('cinemas/new', "CinemaController::new");
$routes->get('cinemas/(:num)', "CinemaController::show/$1");
$routes->get('cinemas/edit/(:num)', "CinemaController::edit/$1");

//api
$routes->post('api/cinemas/v1', "CinemaController::create");
$routes->put('api/cinemas/v1/(:num)', "CinemaController::update/$1");
$routes->delete('api/cinemas/v1/(:num)', "CinemaController::delete/$1");