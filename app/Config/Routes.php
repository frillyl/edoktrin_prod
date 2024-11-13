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
$routes->get('/login/change_password', 'Login::change_password');
$routes->post('login/update_password', 'Login::update_password');
// Dashboard
$routes->get('/dashboard', 'Dashboard::index');
// Profile
$routes->get('/profile', 'Profile::index');
$routes->post('profile/edit', 'Profile::edit');
// Master Pengguna
$routes->get('/master/pengguna', 'Master::index_pengguna');
$routes->post('master/pengguna/add', 'Master::add_pengguna');
$routes->post('master/pengguna/edit/(:segment)', 'Master::edit_pengguna/$1');
$routes->get('master/pengguna/delete/(:segment)', 'Master::delete_pengguna/$1');
$routes->get('master/pengguna/reset_password/(:segment)', 'Master::reset_password/$1');
// Notifikasi
$routes->get('/notifikasi/markAllRead', 'Notifikasi::markAllRead');
$routes->post('notifikasi/markAsRead', 'Notifikasi::markAsRead');
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
$routes->post('master/klasifikasi/add', 'Master::add_klasifikasi');
$routes->post('master/klasifikasi/edit/(:segment)', 'Master::edit_klasifikasi/$1');
$routes->get('master/klasifikasi/delete/(:segment)', 'Master::delete_klasifikasi/$1');
// Manajemen Arsip
$routes->get('/manajemen/arsip', 'Arsip::index');
$routes->post('manajemen/arsip/add', 'Arsip::add');
$routes->post('manajemen/arsip/edit/(:segment)', 'Arsip::edit/$1');
$routes->get('manajemen/arsip/delete/(:segment)', 'Arsip::delete/$1');
$routes->get('/manajemen/arsip/preview/(:any)', function ($fileName) {
    $path = WRITEPATH . 'uploads/' . $fileName;
    if (file_exists($path)) {
        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});
