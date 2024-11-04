<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');
// Login & Logout
$routes->get('/login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');
// Dashboard
$routes->get('/dashboard', 'Dashboard::index');
// Master Pengguna
$routes->get('/master/pengguna', 'Master::index_pengguna');
$routes->post('master/pengguna/add', 'Master::add_pengguna');
$routes->post('master/pengguna/edit/(:segment)', 'Master::edit_pengguna/$1');
$routes->get('master/pengguna/delete/(:segment)', 'Master::delete_pengguna/$1');
$routes->post('master/pengguna/reset_password/(:segment)', 'Master::reset_password/$1');
// Master Asal Doktrin
$routes->get('/master/pencipta', 'Master::index_pencipta');
$routes->post('master/pencipta/add', 'Master::add_pencipta');
$routes->post('master/pencipta/edit/(:segment)', 'Master::edit_pencipta/$1');
$routes->get('master/pencipta/delete/(:segment)', 'Master::delete_pencipta/$1');
// Master Unit Organisasi
$routes->get('/master/unit', 'Master::index_unit');
$routes->post('master/unit/add', 'Master::add_unit');
$routes->post('master/unit/edit/(:segment)', 'Master::edit_unit/$1');
$routes->get('master/unit/delete/(:segment)', 'Master::delete_unit/$1');
// Master Jenis Doktrin
$routes->get('/master/klasifikasi', 'Master::index_klasifikasi');
// Manajemen Arsip
$routes->get('/manajemen/arsip', 'Arsip::index');
