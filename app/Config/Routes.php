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
$routes->get('users', 'WorkerController::index');
$routes->get('users/new', "WorkerController::new");
$routes->post('users', "WorkerController::create");
$routes->get('users/(:num)', "WorkerController::show/$1");
$routes->get('users/edit/(:num)', "WorkerController::edit/$1");
$routes->put('users/(:num)', "WorkerController::update/$1");
$routes->delete('users/(:num)', "WorkerController::delete/$1");
