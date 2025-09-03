<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');

$routes->get('/hello', 'Hello::index');

$routes->get('/dosen', 'Dosen::display');

$routes->get('/mahasiswa', 'Mahasiswa::index');
$routes->get('/mahasiswa/loop', 'Mahasiswa::tabelLoop');
$routes->get('/mahasiswa/list', 'Mahasiswa::list');

// Detail 
$routes->get('/mahasiswa/detail/(:segment)', 'Mahasiswa::detail/$1');

// Search
$routes->get('/mahasiswa/search', 'Mahasiswa::search');

// Create dan Insert
$routes->get('/mahasiswa/create', 'Mahasiswa::create');
$routes->post('/mahasiswa/store', 'Mahasiswa::store');

// Edit dan Update
$routes->get('/mahasiswa/edit/(:segment)', 'Mahasiswa::edit/$1');
$routes->post('/mahasiswa/update/(:segment)', 'Mahasiswa::update/$1');

// Delete
$routes->get('/mahasiswa/delete/(:segment)', 'Mahasiswa::delete/$1');