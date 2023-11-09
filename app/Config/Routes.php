<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');


 //RUTAS CRUD USUARIOS

 $routes->get('users', 'UserController::index');
 $routes->get('users/new', "UserController::new");
 $routes->post('users', "UserController::create");
 $routes->get('users/(:num)', "UserController::show/$1");
 $routes->get('users/edit/(:num)', "UserController::edit/$1");
 $routes->put('users/(:num)', "UserController::update/$1");
 $routes->delete('users/(:num)', "UserController::delete/$1");