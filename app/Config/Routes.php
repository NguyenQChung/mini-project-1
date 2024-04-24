<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Home', 'Home::index');

//Routes of Login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::do_Login');

$routes->get('/register', 'Register::index');

$routes->get('/tickets', 'Tickets::index');

$routes->get('/logout', 'Login::logout');

$routes->get('test', 'test::index');