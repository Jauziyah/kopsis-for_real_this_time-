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
$routes->group('admin', ['filter' => 'admin_toko'], function($routes){
    $routes->get('/', 'AdminDisplayPage::index', ['as' => 'admin.product_view']);
});
$routes->group('owner', ['filter' => 'owner'], function($routes){
    $routes->get('/', 'OwnerDisplayPage::index', ['as' => 'owner.product_view']);
});
$routes->group('pelanggan', ['filter' => 'pelanggan'], function($routes){
    $routes->get('/', 'PelangganDisplayPage::index', ['as' => 'pelanggan.main_view']);
});