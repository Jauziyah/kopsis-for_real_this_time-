<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes, ['except' => ['register', 'login']]);

// Custom login
$routes->get('login', 'LoginAdd::loginView');
$routes->post('login', 'LoginAdd::loginAction', ['as' => 'login.action']);

// Custom Register
$routes->get('register', 'RegisterAdd::index', ['as' => 'register']);
$routes->post('register', 'RegisterAdd::registerAction' ,['as' => 'register.action']);


// Admin Toko
$routes->group('admin_toko', ['filter' => 'admin_toko'], function($routes){
    $routes->get('/', 'AdminTokoDisplayPage::index', ['as' => 'admin_toko.product_view']);
});

// owner
$routes->group('owner', ['filter' => 'owner'], function($routes){
    $routes->get('/', 'OwnerDisplayPage::index', ['as' => 'owner.product_view']);
});

// Pelanggan
$routes->group('pelanggan', ['filter' => 'pelanggan'], function($routes){
    $routes->get('/', 'PelangganDisplayPage::index', ['as' => 'pelanggan.main_view']);
});