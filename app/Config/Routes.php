<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Landing Page
$routes->get('/', 'Landing::index');
$routes->get('/arsip/preview/(:any)', function ($fileName) {
    $path = WRITEPATH . 'uploads/' . $fileName;
    if (file_exists($path)) {
        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});
$routes->get('/arsip/download/(:any)', function ($fileName) {
    $path = WRITEPATH . 'uploads/' . $fileName;
    if (file_exists($path)) {
        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});
// Login & Logout
$routes->get('/login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');
$routes->get('/login/change_password', 'Login::change_password');
$routes->post('login/update_password', 'Login::update_password');
// Dashboard
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->post('/dashboard/search', 'Dashboard::search', ['filter' => 'auth']);
$routes->get('/dashboard/arsip/preview/(:any)', function ($fileName) {
    $path = WRITEPATH . 'uploads/' . $fileName;
    if (file_exists($path)) {
        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});
$routes->get('/dashboard/arsip/download/(:any)', function ($fileName) {
    $path = WRITEPATH . 'uploads/' . $fileName;
    if (file_exists($path)) {
        header('Content-Type: application/pdf');
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});
// Profile
$routes->group('profile', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Profile::index');
    $routes->post('edit', 'Profile::edit');
});
$routes->group('master', ['filter' => 'auth:1,2'], function ($routes) {
    // Master Pengguna
    $routes->get('pengguna', 'Master::index_pengguna');
    $routes->post('pengguna/add', 'Master::add_pengguna');
    $routes->post('pengguna/edit/(:segment)', 'Master::edit_pengguna/$1');
    $routes->get('pengguna/delete/(:segment)', 'Master::delete_pengguna/$1');
    $routes->get('pengguna/reset_password/(:segment)', 'Master::reset_password/$1');
    // Master Asal Doktrin
    $routes->get('pencipta', 'Master::index_pencipta');
    $routes->post('pencipta/add', 'Master::add_pencipta');
    $routes->post('pencipta/edit/(:segment)', 'Master::edit_pencipta/$1');
    $routes->get('pencipta/delete/(:segment)', 'Master::delete_pencipta/$1');
    // Master Unit Organisasi
    $routes->get('unit', 'Master::index_unit');
    $routes->post('unit/add', 'Master::add_unit');
    $routes->post('unit/edit/(:segment)', 'Master::edit_unit/$1');
    $routes->get('unit/delete/(:segment)', 'Master::delete_unit/$1');
    // Master Jenis Doktrin
    $routes->get('klasifikasi', 'Master::index_klasifikasi');
    $routes->post('klasifikasi/add', 'Master::add_klasifikasi');
    $routes->post('klasifikasi/edit/(:segment)', 'Master::edit_klasifikasi/$1');
    $routes->get('klasifikasi/delete/(:segment)', 'Master::delete_klasifikasi/$1');
});


$routes->group('manajemen', ['filter' => 'auth:1,2,3'], function ($routes) {
    // Manajemen Arsip
    $routes->get('arsip', 'Arsip::index');
    $routes->post('arsip/add', 'Arsip::add');
    $routes->post('arsip/edit/(:segment)', 'Arsip::edit/$1');
    $routes->get('arsip/delete/(:segment)', 'Arsip::delete/$1');
});
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
// Notifikasi
$routes->group('notifikasi', ['filter' => 'auth:1,2,3,4'], function ($routes) {
    $routes->get('markAllRead', 'Notifikasi::markAllRead');
    $routes->post('markAsRead', 'Notifikasi::markAsRead');
});
