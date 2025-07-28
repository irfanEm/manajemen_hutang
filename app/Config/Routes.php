<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/test', static function(){
    return "Route berjalan lancar !"; 
});

// login
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
// dashboard
$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth']);
// agents
$routes->get('/agents', 'Agent::index', ['filter' => 'auth']);
$routes->get('/agents/create', 'Agent::create', ['filter' => 'auth']);
$routes->post('/agents/store', 'Agent::store', ['filter' => 'auth']);
$routes->get('/agents/edit/(:num)', 'Agent::edit/$1', ['filter' => 'auth']);
$routes->put('/agents/update/(:num)', 'Agent::update/$1', ['filter' => 'auth']);
$routes->get('/agents/delete/(:num)', 'Agent::create', ['filter' => 'auth']);
// payment methods
$routes->get('/payment-methods', 'PaymentMethodController::index', ['filter' => 'auth']);
$routes->get('/payment-methods/create', 'PaymentMethodController::create', ['filter' => 'auth']);
$routes->post('/payment-methods/store', 'PaymentMethodController::store', ['filter' => 'auth']);
$routes->get('/payment-methods/edit/(:num)', 'PaymentMethodController::edit/$1', ['filter' => 'auth']);
$routes->put('/payment-methods/update/(:num)', 'PaymentMethodController::update/$1', ['filter' => 'auth']);
$routes->post('/payment-methods/delete/(:num)', 'PaymentMethodController::delete/$1', ['filter' => 'auth']);
// Hutang
$routes->get('/hutang', 'Hutang::index', ['filter' => 'auth']);
$routes->get('/hutang/detail/(:num)', 'Hutang::show/$1', ['filter' => 'auth']);
$routes->get('/hutang/create', 'Hutang::new', ['filter' => 'auth']);
$routes->post('/hutang/store', 'Hutang::create', ['filter' => 'auth']);