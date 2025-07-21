<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/test', static function(){
    return "Route berjalan lancar !"; 
});

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');

$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth']);