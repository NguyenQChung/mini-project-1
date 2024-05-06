<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Home', 'Home::index');
$routes->get('/Error', 'Error::index');

//Routes of Login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::do_Login');

$routes->get('/register', 'Register::index');

$routes->get('/tickets', 'Tickets::index');
$routes->post('/tickets', 'Tickets::do_create');

$routes->get('/logout', 'Login::logout');

$routes->get('test', 'test::index');

$routes->get('/quanly1', 'Quan_ly::index1', );
$routes->get('/quanly', 'Quan_ly::index', );
$routes->post('/quanly', 'Quan_ly::index', );

$routes->post('/saveUser', 'Quan_Ly::saveUser');
$routes->post('/quanly/ajaxPagination', 'Quan_ly::ajaxPagination');

$routes->get('/getSingleUser/(:num)', 'Quan_ly::getSingleUser/$1');
$routes->get('/getSingleTicket/(:num)', 'List_Ticket::getSingleTicket/$1');

$routes->post('/updateUser', 'Quan_ly::updateUser');
$routes->post('/updateTicket', 'List_Ticket::updateTicket');

// $routes->post('/deleteUser/(:num)', 'Quan_ly::deleteUser/$1');
$routes->post('/deleteUser', 'Quan_ly::deleteUser');
$routes->post('/deleteTicket', 'List_Ticket::deleteTicket');

$routes->post('/resetPassword', 'Quan_ly::resetPassword');

$routes->get('/ListTicket', 'List_Ticket::index');
$routes->post('/ListTicket', 'List_Ticket::index');

$routes->post('/updateStatus', 'List_Ticket::updateStatus');

$routes->get('/search', 'Quan_ly::search');

$routes->get('/profile', 'ProfileController::index');

$routes->post('/changepassword', 'ProfileController::changePassword');