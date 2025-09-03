<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/login/logout', 'Login::logout');

// Grup yang butuh login
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/home', 'Home::index');
    $routes->get('/mahasiswa', 'Mahasiswa::index');
    $routes->get('/mahasiswa/detail/(:segment)', 'Mahasiswa::detail/$1');
    $routes->get('/mahasiswa/create', 'Mahasiswa::create');
    $routes->post('/mahasiswa/store', 'Mahasiswa::store');
    $routes->get('/mahasiswa/edit/(:segment)', 'Mahasiswa::edit/$1');
    $routes->post('/mahasiswa/update/(:segment)', 'Mahasiswa::update/$1');
    $routes->get('/mahasiswa/delete/(:segment)', 'Mahasiswa::delete/$1');
});
