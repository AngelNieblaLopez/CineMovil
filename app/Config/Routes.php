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




//RUTAS CRUD USUARIOS prueba
$routes->get('users', 'UserController::index');
$routes->get('users/new', "UserController::new");
$routes->post('users', "UserController::create");
$routes->get('users/(:num)', "UserController::show/$1");
$routes->get('users/edit/(:num)', "UserController::edit/$1");
$routes->put('users/(:num)', "UserController::update/$1");
$routes->delete('users/(:num)', "UserController::delete/$1");
