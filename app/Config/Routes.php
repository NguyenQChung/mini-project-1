<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Home', 'Home::index');

//Routes of Login
$routes->get('/Login', 'Login::index');
$routes->post('/Login', 'Login::do_Login');

$routes->get('/Register', 'Register::index');


$routes->get('/Tickets', 'Tickets::index');