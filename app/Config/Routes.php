<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Home', 'Home::index');
$routes->get('/Error','Error::index');

//Routes of Login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::do_Login');

$routes->get('/register', 'Register::index');

$routes->get('/tickets', 'Tickets::index');

$routes->get('/logout', 'Login::logout');

$routes->get('test', 'test::index');

$routes->get('/quanly', 'Quan_ly::index', );
$routes->post('/quanly', 'Quan_ly::index', );

$routes->post('/saveUser', 'Quan_Ly::saveUser');
$routes->post('/quanly/ajaxPagination', 'Quan_ly::ajaxPagination');

$routes->get('/getSingleUser/(:num)', 'Quan_ly::getSingleUser/$1');

$routes->post('/updateUser', 'Quan_ly::updateUser');

// $routes->post('/deleteUser/(:num)', 'Quan_ly::deleteUser/$1');
$routes->post('/deleteUser', 'Quan_ly::deleteUser');