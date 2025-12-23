<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
// Register
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::processRegister');

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::processLogin');

// Dashboard (butuh login - bisa pakai filter nantinya)
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/profile', 'User::profile');
$routes->get('/edit-profile', 'User::editProfile');
$routes->post('/edit-profile', 'User::updateProfile');
$routes->get('/pindai', 'ScanController::index');
$routes->get('/proses', 'ScanController::proses');
$routes->get('/manual', 'ScanController::manual');
$routes->get('/hasilManual', 'ScanController::hasilManual'); // nanti buat method hasilManual juga

$routes->get('/history', 'ScanController::history');
$routes->post('/history/delete/(:num)', 'ScanController::delete/$1'); // route delete

$routes->get('/barcode', 'Barcode::index');
$routes->post('/barcode/save', 'Barcode::save');
$routes->get('/hasilmanual/(:num)', 'Barcode::hasilmanual/$1');







